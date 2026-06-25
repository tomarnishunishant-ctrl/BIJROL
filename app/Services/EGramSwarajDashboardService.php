<?php

namespace App\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class EGramSwarajDashboardService
{
    private const STATE_CODE = 9;
    private const LOCAL_BODY_CODE = 48532;

    private string $baseUrl = 'https://egramswaraj.gov.in/webservice';

    public function dashboard(bool $forceRefresh = false): array
    {
        if (! $forceRefresh && $cached = $this->readCache()) {
            return $this->hydrateDashboard($cached);
        }

        try {
            $dashboard = $this->fetchDashboard();
            $this->writeCache($dashboard);

            return $dashboard;
        } catch (\Throwable $exception) {
            if ($cached = $this->readCache()) {
                $cached['source']['status'] = 'cache';
                $cached['source']['message'] = 'Showing last synced eGramSwaraj data. Latest sync failed: '.$exception->getMessage();
                $cached['knowYourPanchayat'] = $this->fetchKnowYourPanchayatProfile();
                $this->writeCache($cached);

                return $this->hydrateDashboard($cached);
            }

            $sample = $this->sampleDashboard();
            $sample['source']['message'] = 'eGramSwaraj sync failed and no cache exists yet: '.$exception->getMessage();

            return $sample;
        }
    }

    public function sync(): array
    {
        return $this->dashboard(true);
    }

    private function fetchDashboard(): array
    {
        $years = $this->planningYears();
        $activities = [];
        $allocations = [];
        $technicalApprovals = [];
        $adminApprovals = [];
        $physicalProgress = [];

        foreach ($years as $year) {
            $activities = array_merge($activities, $this->fetchEndpoint('getLbApprovedActivityData', $year));
            $allocations = array_merge($allocations, $this->fetchEndpoint('getLbAllocatedAmountData', $year));
            $technicalApprovals = array_merge($technicalApprovals, $this->fetchEndpoint('getLbTechnicalApprovalData', $year));
            $adminApprovals = array_merge($adminApprovals, $this->fetchEndpoint('getLbAdmApprovalData', $year));
            $physicalProgress = array_merge($physicalProgress, $this->fetchEndpoint('getLbPhysicalProgressData', $year));
        }

        if (! count($activities) && ! count($allocations) && ! count($physicalProgress)) {
            throw new \RuntimeException('No eGramSwaraj records returned for LGD 48532.');
        }

        return $this->transform($activities, $allocations, $technicalApprovals, $adminApprovals, $physicalProgress, $years);
    }

    private function fetchEndpoint(string $endpoint, int $year): array
    {
        $url = sprintf(
            '%s/%s/%d/%d/%d',
            $this->baseUrl,
            $endpoint,
            self::STATE_CODE,
            $year,
            self::LOCAL_BODY_CODE
        );

        $response = Http::acceptJson()
            ->timeout(18)
            ->retry(2, 500)
            ->get($url);

        if (! $response->successful()) {
            return [];
        }

        $records = $this->recordsFromResponse($response->json());

        if ($endpoint === 'getLbAllocatedAmountData') {
            return $this->flattenNestedRecords($records, 'budgetaryAllocationSchemeWebService');
        }

        return $records;
    }

    private function recordsFromResponse(mixed $payload): array
    {
        if (! is_array($payload)) {
            return [];
        }

        foreach (['data', 'records', 'result', 'response', 'output'] as $key) {
            if (isset($payload[$key]) && is_array($payload[$key])) {
                return $this->recordsFromResponse($payload[$key]);
            }
        }

        if (Arr::isAssoc($payload)) {
            return [$payload];
        }

        return array_values(array_filter($payload, 'is_array'));
    }

    private function flattenNestedRecords(array $records, string $nestedKey): array
    {
        $flattened = [];

        foreach ($records as $record) {
            if (isset($record[$nestedKey]) && is_array($record[$nestedKey])) {
                foreach ($record[$nestedKey] as $nestedRecord) {
                    if (is_array($nestedRecord)) {
                        $flattened[] = array_merge(Arr::except($record, [$nestedKey]), $nestedRecord);
                    }
                }
            } else {
                $flattened[] = $record;
            }
        }

        return $flattened;
    }

    private function transform(array $activities, array $allocations, array $technicalApprovals, array $adminApprovals, array $physicalProgress, array $years): array
    {
        $plannedAmount = collect($activities)->sum(fn (array $activity) => $this->numericField($activity, ['amountTotal', 'totalCost', 'wrkAdmApprFndSnctnGen']));
        $allocatedAmount = collect($allocations)->sum(fn (array $row) => $this->numericField($row, ['totalBudjAmount', 'totalBudgetAmount', 'alocationAmountGen', 'allocationAmountGen']));
        $proposedAmount = collect($adminApprovals)->sum(fn (array $approval) => $this->numericField($approval, ['wrkProposedCost']));
        $sanctionedAmount = collect($adminApprovals)->sum(fn (array $approval) => $this->approvalSanctionedAmount($approval));

        $works = collect($activities)->map(function (array $activity, int $index) use ($physicalProgress, $years) {
            $activityCode = $this->field($activity, ['activityCode', 'activityCd']);
            $progress = $this->progressForActivity($physicalProgress, $activityCode);
            $status = $this->field($activity, ['activityStts', 'activityStatus', 'status']) ?: $progress['status'];

            return [
                'id' => $index + 1,
                'activityCode' => $activityCode,
                'name' => $this->field($activity, ['activityName', 'name']) ?: 'Untitled activity',
                'category' => $this->field($activity, ['focusArea', 'mainAstCtgry', 'activityType']) ?: 'Development',
                'status' => $this->humanStatus($status),
                'budget' => $this->formatRupees($this->numericField($activity, ['amountTotal', 'totalCost', 'wrkAdmApprFndSnctnGen'])),
                'date' => $this->field($activity, ['planYear', 'wrkPlnYr']) ?: implode('-', $years),
                'progress' => $progress['percent'],
            ];
        })->values()->all();

        $schemeIndex = 0;
        $schemes = collect($allocations)->groupBy(fn (array $row) => $this->field($row, ['schemeCode', 'schemeName']) ?: 'Scheme')
            ->map(function ($rows, string $scheme) use (&$schemeIndex) {
                $total = $rows->sum(fn (array $row) => $this->numericField($row, ['totalBudjAmount', 'totalBudgetAmount', 'alocationAmountGen', 'allocationAmountGen']));
                $schemeIndex++;

                return [
                    'id' => $schemeIndex,
                    'name' => $scheme,
                    'department' => 'eGramSwaraj Resource Envelope',
                    'beneficiaries' => $rows->count(),
                    'budget' => $this->formatRupees($total),
                    'status' => 'Active',
                ];
            })->values()->all();

        $assets = collect($activities)->filter(fn (array $activity) => $this->field($activity, ['mainAstCtgry', 'mainAstSubCtgry', 'outputTyp']))
            ->take(12)
            ->values()
            ->map(function (array $activity, int $index) {
                return [
                    'id' => $index + 1,
                    'name' => $this->field($activity, ['mainAstSubCtgry', 'outputTyp', 'activityName']) ?: 'Panchayat Asset',
                    'type' => $this->field($activity, ['mainAstCtgry', 'mainAstUntTyp']) ?: 'Asset',
                    'location' => 'Bijrol',
                    'value' => $this->formatRupees($this->numericField($activity, ['totalCost', 'amountTotal'])),
                    'condition' => 'Good',
                ];
            })->all();

        $payments = collect($adminApprovals)->sortByDesc(fn (array $approval) => $this->field($approval, ['wrkAdmApprSnctnOrdrDt']) ?: $this->field($approval, ['wrkPlnYr', 'planYear']))
            ->take(12)
            ->values()
            ->map(function (array $approval, int $index) {
            return [
                'id' => $index + 1,
                'recipient' => $this->field($approval, ['wrkAdmApprIssAuthrty']) ?: 'Gram Panchayat',
                'work' => 'Activity '.$this->field($approval, ['activityCd', 'activityCode']),
                'amount' => $this->formatRupees($this->approvalSanctionedAmount($approval)),
                'date' => $this->field($approval, ['wrkAdmApprSnctnOrdrDt']) ?: ($this->field($approval, ['wrkPlnYr', 'planYear']) ?: now()->format('Y')),
                'status' => 'Approved',
            ];
        })->all();

        $statusCounts = collect($works)->countBy('status');
        $schemeDistribution = collect($works)->countBy('category')->sortDesc()->take(6);

        return [
            'source' => [
                'status' => 'live',
                'portal' => 'eGramSwaraj',
                'stateCode' => self::STATE_CODE,
                'localBodyCode' => self::LOCAL_BODY_CODE,
                'planningYears' => $years,
                'syncedAt' => now()->toIso8601String(),
                'message' => 'Live data synced from official eGramSwaraj webservices where available.',
            ],
            'stats' => [
                'totalPopulation' => 11742,
                'households' => 1809,
                'literacyRate' => 63.75,
                'pendingWorks' => (int) (($statusCounts['Pending'] ?? 0) + ($statusCounts['Not Started'] ?? 0)),
                'totalSchemes' => max(count($schemes), count($allocations)),
                'totalAssets' => max(count($assets), count($physicalProgress)),
                'totalWorks' => count($works),
                'plannedAmount' => $this->formatRupees($plannedAmount),
                'allocatedAmount' => $this->formatRupees($allocatedAmount),
                'proposedAmount' => $this->formatRupees($proposedAmount),
                'sanctionedAmount' => $this->formatRupees($sanctionedAmount),
            ],
            'populationTrend' => $this->populationTrend(),
            'schemeDistribution' => [
                'labels' => $schemeDistribution->keys()->values()->all() ?: ['Development'],
                'values' => $schemeDistribution->values()->all() ?: [count($works)],
            ],
            'monthlyProgress' => $this->monthlyProgress($works),
            'works' => $works,
            'assets' => $assets,
            'schemes' => $schemes,
            'payments' => $payments,
            'approvals' => [
                'technical' => $technicalApprovals,
                'admin' => $adminApprovals,
            ],
            'knowYourPanchayat' => $this->fetchKnowYourPanchayatProfile(),
        ];
    }

    private function planningYears(): array
    {
        $year = (int) now('Asia/Kolkata')->format('Y');

        return [$year, $year - 1, $year - 2];
    }

    private function progressForActivity(array $physicalProgress, mixed $activityCode): array
    {
        if (! $activityCode) {
            return ['percent' => 0, 'status' => 'Pending'];
        }

        $records = collect($physicalProgress)->filter(fn (array $row) => (string) $this->field($row, ['activityCd', 'activityCode']) === (string) $activityCode);

        if ($records->isEmpty()) {
            return ['percent' => 0, 'status' => 'Pending'];
        }

        $completed = $records->filter(fn (array $row) => in_array(strtolower((string) $this->field($row, ['completed', 'isCompleted'])), ['1', 'true', 'yes', 'completed'], true))->count();
        $percent = (int) round(($completed / max($records->count(), 1)) * 100);

        return [
            'percent' => $percent,
            'status' => $percent >= 100 ? 'Completed' : 'In Progress',
        ];
    }

    private function monthlyProgress(array $works): array
    {
        $labels = ['Apr','May','Jun','Jul','Aug','Sep'];
        $completed = count(array_filter($works, fn (array $work) => $work['status'] === 'Completed'));
        $ongoing = count(array_filter($works, fn (array $work) => in_array($work['status'], ['In Progress', 'Ongoing'], true)));

        return [
            'labels' => $labels,
            'completed' => [0, 0, 0, 0, 0, $completed],
            'ongoing' => [0, 0, 0, 0, 0, $ongoing],
        ];
    }

    private function populationTrend(): array
    {
        return [
            'labels' => ['Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec','Jan','Feb','Mar'],
            'male' => [5800, 5820, 5835, 5840, 5850, 5860, 5870, 5880, 5890, 5900, 5910, 5920],
            'female' => [5800, 5810, 5825, 5830, 5840, 5850, 5860, 5870, 5880, 5890, 5900, 5910],
        ];
    }

    private function field(array $row, array $keys): mixed
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, $row) && $row[$key] !== null && $row[$key] !== '') {
                return $row[$key];
            }
        }

        return null;
    }

    private function numericField(array $row, array $keys): float
    {
        foreach ($keys as $key) {
            if (array_key_exists($key, $row) && is_numeric($row[$key])) {
                return (float) $row[$key];
            }
        }

        return 0;
    }

    private function humanStatus(mixed $status): string
    {
        $value = strtolower(trim((string) $status));

        return match ($value) {
            '123', 'approved', 'complete', 'completed' => 'Completed',
            '74' => 'Approved',
            '174' => 'Ongoing',
            'ongoing', 'in progress', 'progress' => 'In Progress',
            'not started', 'pending', '' => 'Pending',
            default => ucwords($value),
        };
    }

    private function approvalSanctionedAmount(array $approval): float
    {
        $nestedSchemes = $approval['admApprovalSchemeWebService'] ?? [];

        if (is_array($nestedSchemes) && count($nestedSchemes)) {
            return collect($nestedSchemes)->sum(fn (array $scheme) => $this->numericField($scheme, [
                'fndAllctnSchmTot',
                'wrkAdmApprFndSnctnGen',
                'wrkAdmApprFndSnctnSc',
                'wrkAdmApprFndSnctnSt',
            ]));
        }

        return $this->numericField($approval, ['fndAllctnSchmTot', 'wrkAdmApprFndSnctnGen', 'wrkAdmApprFndSnctnSc', 'wrkAdmApprFndSnctnSt']);
    }

    private function formatRupees(float $amount): string
    {
        return 'Rs. '.number_format($amount, 0, '.', ',');
    }

    private function cachePath(): string
    {
        return storage_path('app/panchayat/egramswaraj-dashboard.json');
    }

    private function readCache(): ?array
    {
        if (! File::exists($this->cachePath())) {
            return null;
        }

        $data = json_decode(File::get($this->cachePath()), true);

        return is_array($data) ? $this->hydrateDashboard($data) : null;
    }

    private function writeCache(array $dashboard): void
    {
        File::ensureDirectoryExists(dirname($this->cachePath()));
        File::put($this->cachePath(), json_encode($dashboard, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    private function hydrateDashboard(array $dashboard): array
    {
        $works = $dashboard['works'] ?? [];
        $schemes = $dashboard['schemes'] ?? [];
        $assets = $dashboard['assets'] ?? [];
        $adminApprovals = $dashboard['approvals']['admin'] ?? [];

        $plannedAmount = collect($works)->sum(fn (array $work) => $this->rupeesToFloat($work['budget'] ?? 0));
        $allocatedAmount = collect($schemes)->sum(fn (array $scheme) => $this->rupeesToFloat($scheme['budget'] ?? 0));
        $proposedAmount = collect($adminApprovals)->sum(fn (array $approval) => $this->numericField($approval, ['wrkProposedCost']));
        $sanctionedAmount = collect($adminApprovals)->sum(fn (array $approval) => $this->approvalSanctionedAmount($approval));
        $statusCounts = collect($works)->countBy('status');

        $dashboard['stats'] = array_merge($dashboard['stats'] ?? [], [
            'pendingWorks' => (int) (($statusCounts['Pending'] ?? 0) + ($statusCounts['Not Started'] ?? 0)),
            'totalSchemes' => max(count($schemes), (int) ($dashboard['stats']['totalSchemes'] ?? 0)),
            'totalAssets' => max(count($assets), (int) ($dashboard['stats']['totalAssets'] ?? 0)),
            'totalWorks' => count($works),
            'plannedAmount' => $this->formatRupees($plannedAmount),
            'allocatedAmount' => $this->formatRupees($allocatedAmount),
            'proposedAmount' => $this->formatRupees($proposedAmount),
            'sanctionedAmount' => $this->formatRupees($sanctionedAmount),
        ]);

        $dashboard['knowYourPanchayat'] = $dashboard['knowYourPanchayat'] ?? $this->defaultKnowYourPanchayatProfile('cache');

        if (count($adminApprovals)) {
            $dashboard['payments'] = collect($adminApprovals)
                ->sortByDesc(fn (array $approval) => $this->field($approval, ['wrkAdmApprSnctnOrdrDt']) ?: $this->field($approval, ['wrkPlnYr', 'planYear']))
                ->take(12)
                ->values()
                ->map(function (array $approval, int $index) {
                    return [
                        'id' => $index + 1,
                        'recipient' => $this->field($approval, ['wrkAdmApprIssAuthrty']) ?: 'Gram Panchayat',
                        'work' => 'Activity '.$this->field($approval, ['activityCd', 'activityCode']),
                        'amount' => $this->formatRupees($this->approvalSanctionedAmount($approval)),
                        'date' => $this->field($approval, ['wrkAdmApprSnctnOrdrDt']) ?: ($this->field($approval, ['wrkPlnYr', 'planYear']) ?: now()->format('Y')),
                        'status' => 'Approved',
                    ];
                })
                ->all();
        }

        return $dashboard;
    }

    private function rupeesToFloat(mixed $amount): float
    {
        if (is_numeric($amount)) {
            return (float) $amount;
        }

        return (float) preg_replace('/[^0-9]/', '', (string) $amount);
    }

    private function fetchKnowYourPanchayatProfile(): array
    {
        try {
            $body = implode("\n", [
                'callCount=1',
                'page=/demo/knowYourPanchayat.do',
                'httpSessionId=',
                'scriptSessionId=1234567890ABCDEF',
                'windowName=',
                'c0-scriptName=lgdBaseService',
                'c0-methodName=getLbHierarchyDetails',
                'c0-id=0',
                'c0-param0=number:'.self::LOCAL_BODY_CODE,
                'batchId=0',
                '',
            ]);

            $response = Http::withHeaders([
                'Content-Type' => 'text/plain',
                'Referer' => 'https://egramswaraj.gov.in/demo/knowYourPanchayat.do',
            ])->withBody($body, 'text/plain')
                ->timeout(18)
                ->retry(2, 500)
                ->post('https://egramswaraj.gov.in/demo/dwr/call/plaincall/lgdBaseService.getLbHierarchyDetails.dwr');

            if (! $response->successful()) {
                return $this->defaultKnowYourPanchayatProfile('cache');
            }

            if (preg_match('/handleCallback\("0","0","([^"]+)"/', $response->body(), $matches)) {
                $hierarchy = stripcslashes($matches[1]);
                $parts = explode('@', $hierarchy);

                return array_merge($this->defaultKnowYourPanchayatProfile('live'), [
                    'hierarchy' => $parts[0] ?? $hierarchy,
                    'village' => $parts[1] ?? 'Bijrol',
                    'syncedAt' => now()->toIso8601String(),
                ]);
            }
        } catch (\Throwable) {
            return $this->defaultKnowYourPanchayatProfile('cache');
        }

        return $this->defaultKnowYourPanchayatProfile('cache');
    }

    private function defaultKnowYourPanchayatProfile(string $status = 'cache'): array
    {
        return [
            'status' => $status,
            'officialUrl' => 'https://egramswaraj.gov.in/demo/knowYourPanchayat.do',
            'state' => 'Uttar Pradesh',
            'district' => 'Baghpat',
            'block' => 'Baraut',
            'gramPanchayat' => 'Bijrol',
            'localBodyCode' => self::LOCAL_BODY_CODE,
            'panchayatType' => 'Gram Panchayat',
            'hierarchy' => 'Bijrol(Gram Panchayat),Baraut(Kshetra Panchayat),Baghpat(Zilla Panchayat),Uttar Pradesh',
            'village' => 'Bijrol',
            'note' => 'Official Know Your Panchayat page final report captcha protected hai. Dashboard public DWR hierarchy aur eGramSwaraj webservice records ko cache karke dikhata hai.',
            'syncedAt' => now()->toIso8601String(),
        ];
    }

    private function sampleDashboard(): array
    {
        return [
            'source' => [
                'status' => 'sample',
                'portal' => 'eGramSwaraj',
                'stateCode' => self::STATE_CODE,
                'localBodyCode' => self::LOCAL_BODY_CODE,
                'planningYears' => $this->planningYears(),
                'syncedAt' => now()->toIso8601String(),
                'message' => 'Sample fallback data is shown until the first successful eGramSwaraj sync.',
            ],
            'stats' => [
                'totalPopulation' => 11742,
                'households' => 1809,
                'literacyRate' => 63.75,
                'pendingWorks' => 0,
                'totalSchemes' => 0,
                'totalAssets' => 0,
                'totalWorks' => 0,
                'plannedAmount' => 'Rs. 0',
                'allocatedAmount' => 'Rs. 0',
                'proposedAmount' => 'Rs. 0',
                'sanctionedAmount' => 'Rs. 0',
            ],
            'populationTrend' => $this->populationTrend(),
            'schemeDistribution' => ['labels' => ['No live records'], 'values' => [1]],
            'monthlyProgress' => ['labels' => ['Apr','May','Jun','Jul','Aug','Sep'], 'completed' => [0,0,0,0,0,0], 'ongoing' => [0,0,0,0,0,0]],
            'works' => [],
            'assets' => [],
            'schemes' => [],
            'payments' => [],
            'approvals' => ['technical' => [], 'admin' => []],
            'knowYourPanchayat' => $this->defaultKnowYourPanchayatProfile('sample'),
        ];
    }
}
