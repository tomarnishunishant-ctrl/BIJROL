<?php

namespace App\Console\Commands;

use App\Services\EGramSwarajDashboardService;
use Illuminate\Console\Command;

class SyncEGramSwarajDashboard extends Command
{
    protected $signature = 'panchayat:sync-egramswaraj';

    protected $description = 'Sync Bijrol Gram Panchayat dashboard data from eGramSwaraj.';

    public function handle(EGramSwarajDashboardService $service): int
    {
        $dashboard = $service->sync();
        $source = $dashboard['source'] ?? [];

        $this->info('Bijrol eGramSwaraj dashboard sync completed.');
        $this->line('Status: '.($source['status'] ?? 'unknown'));
        $this->line('LGD Local Body Code: '.($source['localBodyCode'] ?? 'unknown'));
        $this->line('Synced at: '.($source['syncedAt'] ?? now()->toIso8601String()));
        $this->line('Works: '.count($dashboard['works'] ?? []));
        $this->line('Schemes: '.count($dashboard['schemes'] ?? []));
        $this->line('Assets: '.count($dashboard['assets'] ?? []));

        return self::SUCCESS;
    }
}
