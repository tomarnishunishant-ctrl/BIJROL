<?php

namespace App\Http\Controllers;

use App\Models\GovernmentEmployee;
use App\Models\Achiever;
use App\Models\VillageSuggestion;
use App\Models\News;
use App\Models\Event;
use App\Models\Clinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    private function ensureAdmin(Request $request)
    {
        if (!$request->session()->get('is_admin')) {
            return redirect()->route('admin.login');
        }

        return null;
    }

    public function login()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $adminUsername = env('ADMIN_USERNAME', 'admin');
        $adminPassword = env('ADMIN_PASSWORD', 'admin123');

        if ($credentials['username'] === $adminUsername && $credentials['password'] === $adminPassword) {
            $request->session()->put('is_admin', true);

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid username or password.');
    }

    public function dashboard(Request $request)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $villageSuggestions = VillageSuggestion::latest()->get();
        $governmentEmployees = GovernmentEmployee::latest()->get();
        $latestNews = News::latest()->take(5)->get();
        $latestEvents = Event::latest()->take(5)->get();
        $latestAchievers = Achiever::orderBy('display_order')->latest()->take(5)->get();
        $latestClinics = Clinic::orderBy('display_order')->latest()->take(5)->get();
        $recentSuggestions = VillageSuggestion::latest()->take(5)->get();
        $recentEmployees = GovernmentEmployee::latest()->take(5)->get();

        return view('admin.dashboard', [
            'governmentEmployees' => $governmentEmployees,
            'villageSuggestions' => $villageSuggestions,
            'latestNews' => $latestNews,
            'latestEvents' => $latestEvents,
            'latestAchievers' => $latestAchievers,
            'latestClinics' => $latestClinics,
            'recentSuggestions' => $recentSuggestions,
            'recentEmployees' => $recentEmployees,
            'stats' => [
                'employees' => $governmentEmployees->count(),
                'suggestions' => $villageSuggestions->count(),
                'publicSuggestions' => $villageSuggestions->where('is_public', true)->count(),
                'pendingSuggestions' => $villageSuggestions->where('status', 'pending')->count(),
                'news' => News::count(),
                'publishedNews' => News::where('is_published', true)->count(),
                'events' => Event::count(),
                'upcomingEvents' => Event::where('event_date', '>=', now()->toDateString())->count(),
                'achievers' => Achiever::count(),
                'publishedAchievers' => Achiever::where('is_published', true)->count(),
                'clinics' => Clinic::count(),
                'publishedClinics' => Clinic::where('is_published', true)->count(),
            ],
        ]);
    }

    // Clinics CRUD
    public function clinicsIndex(Request $request)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $clinics = Clinic::orderBy('display_order')->latest()->paginate(12);

        return view('admin.clinics.index', compact('clinics'));
    }

    public function clinicsCreate(Request $request)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        return view('admin.clinics.create');
    }

    public function clinicsStore(Request $request)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        Clinic::create($this->validatedClinicData($request));

        return redirect()
            ->route('admin.clinics.index')
            ->with('success', 'Clinic added successfully.');
    }

    public function clinicsEdit(Request $request, Clinic $clinic)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        return view('admin.clinics.edit', compact('clinic'));
    }

    public function clinicsUpdate(Request $request, Clinic $clinic)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $clinic->update($this->validatedClinicData($request));

        return redirect()
            ->route('admin.clinics.index')
            ->with('success', 'Clinic updated successfully.');
    }

    public function clinicsDestroy(Request $request, Clinic $clinic)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $clinic->delete();

        return redirect()
            ->route('admin.clinics.index')
            ->with('success', 'Clinic deleted successfully.');
    }

    private function validatedClinicData(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:180'],
            'doctor_name' => ['nullable', 'string', 'max:160'],
            'clinic_type' => ['nullable', 'string', 'max:120'],
            'location' => ['required', 'string', 'max:220'],
            'phone' => ['nullable', 'string', 'max:40'],
            'timing' => ['nullable', 'string', 'max:120'],
            'services' => ['nullable', 'string', 'max:1200'],
            'display_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        return [
            'name' => $validated['name'],
            'doctor_name' => $validated['doctor_name'] ?? null,
            'clinic_type' => $validated['clinic_type'] ?? null,
            'location' => $validated['location'],
            'phone' => $validated['phone'] ?? null,
            'timing' => $validated['timing'] ?? null,
            'services' => $validated['services'] ?? null,
            'display_order' => (int) ($validated['display_order'] ?? 0),
            'is_published' => $request->boolean('is_published'),
        ];
    }

    // Achievers CRUD
    public function achieversIndex(Request $request)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $achievers = Achiever::orderBy('display_order')->latest()->paginate(10);

        return view('admin.achievers.index', compact('achievers'));
    }

    public function achieversCreate(Request $request)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        return view('admin.achievers.create');
    }

    public function achieversStore(Request $request)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $data = $this->validatedAchieverData($request);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('achiever-photos', 'public');
        }

        Achiever::create($data);

        return redirect()
            ->route('admin.achievers.index')
            ->with('success', 'Who\'s Who profile created successfully.');
    }

    public function achieversEdit(Request $request, Achiever $achiever)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        return view('admin.achievers.edit', compact('achiever'));
    }

    public function achieversUpdate(Request $request, Achiever $achiever)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $data = $this->validatedAchieverData($request, $achiever);

        if ($request->hasFile('photo')) {
            if ($achiever->photo) {
                Storage::disk('public')->delete($achiever->photo);
            }
            $data['photo'] = $request->file('photo')->store('achiever-photos', 'public');
        }

        $achiever->update($data);

        return redirect()
            ->route('admin.achievers.index')
            ->with('success', 'Who\'s Who profile updated successfully.');
    }

    public function achieversDestroy(Request $request, Achiever $achiever)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        if ($achiever->photo) {
            Storage::disk('public')->delete($achiever->photo);
        }

        $achiever->delete();

        return redirect()
            ->route('admin.achievers.index')
            ->with('success', 'Who\'s Who profile deleted successfully.');
    }

    private function validatedAchieverData(Request $request, ?Achiever $achiever = null): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:140'],
            'role' => ['required', 'string', 'max:180'],
            'badge' => ['nullable', 'string', 'max:80'],
            'initials' => ['nullable', 'string', 'max:8'],
            'tone' => ['nullable', 'string', 'max:40'],
            'short_description' => ['nullable', 'string', 'max:600'],
            'profile_summary' => ['nullable', 'string', 'max:4000'],
            'journey_text' => ['nullable', 'string', 'max:8000'],
            'highlights_text' => ['nullable', 'string', 'max:4000'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'display_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $slug = Str::slug($validated['slug'] ?: $validated['name']);
        $baseSlug = $slug;
        $count = 2;

        while (Achiever::where('slug', $slug)
            ->when($achiever, fn ($query) => $query->where('id', '!=', $achiever->id))
            ->exists()) {
            $slug = $baseSlug.'-'.$count;
            $count++;
        }

        return [
            'name' => $validated['name'],
            'slug' => $slug,
            'role' => $validated['role'],
            'badge' => $validated['badge'] ?? null,
            'initials' => $validated['initials'] ?: Str::upper(Str::substr($validated['name'], 0, 2)),
            'tone' => $validated['tone'] ?: 'service',
            'short_description' => $validated['short_description'] ?? null,
            'profile_summary' => $validated['profile_summary'] ?? null,
            'journey' => $this->linesToJourney($validated['journey_text'] ?? ''),
            'highlights' => $this->linesToArray($validated['highlights_text'] ?? ''),
            'display_order' => (int) ($validated['display_order'] ?? 0),
            'is_published' => $request->boolean('is_published'),
        ];
    }

    private function linesToArray(string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }

    private function linesToJourney(string $text): array
    {
        return collect(preg_split('/\r\n|\r|\n/', $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->map(function ($line) {
                $parts = array_map('trim', explode('|', $line, 3));

                return [
                    'year' => $parts[0] ?? 'Milestone',
                    'title' => $parts[1] ?? ($parts[0] ?? 'Milestone'),
                    'text' => $parts[2] ?? '',
                ];
            })
            ->values()
            ->all();
    }

    // News CRUD
    public function newsIndex(Request $request)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function newsCreate(Request $request)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        return view('admin.news.create');
    }

    public function newsStore(Request $request)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ]);

        $data = [
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'is_published' => $request->boolean('is_published'),
            'published_at' => $validated['published_at'],
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news-images', 'public');
        }

        News::create($data);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News article created successfully.');
    }

    public function newsEdit(Request $request, News $news)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        return view('admin.news.edit', compact('news'));
    }

    public function newsUpdate(Request $request, News $news)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
            'published_at' => ['nullable', 'date'],
        ]);

        $data = [
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'is_published' => $request->boolean('is_published'),
            'published_at' => $validated['published_at'],
        ];

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $data['image'] = $request->file('image')->store('news-images', 'public');
        }

        $news->update($data);

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News article updated successfully.');
    }

    public function newsDestroy(Request $request, News $news)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        if ($news->image) {
            Storage::disk('public')->delete($news->image);
        }

        $news->delete();

        return redirect()
            ->route('admin.news.index')
            ->with('success', 'News article deleted successfully.');
    }

    // Events CRUD
    public function eventsIndex(Request $request)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $events = Event::latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function eventsCreate(Request $request)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        return view('admin.events.create');
    }

    public function eventsStore(Request $request)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:200'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'event_date' => $validated['event_date'],
            'location' => $validated['location'],
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->boolean('is_published'),
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('event-images', 'public');
        }

        Event::create($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event created successfully.');
    }

    public function eventsEdit(Request $request, Event $event)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        return view('admin.events.edit', compact('event'));
    }

    public function eventsUpdate(Request $request, Event $event)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'event_date' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:200'],
            'image' => ['nullable', 'image', 'max:2048'],
            'is_featured' => ['nullable', 'boolean'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'event_date' => $validated['event_date'],
            'location' => $validated['location'],
            'is_featured' => $request->boolean('is_featured'),
            'is_published' => $request->boolean('is_published'),
        ];

        if ($request->hasFile('image')) {
            if ($event->image) {
                Storage::disk('public')->delete($event->image);
            }
            $data['image'] = $request->file('image')->store('event-images', 'public');
        }

        $event->update($data);

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event updated successfully.');
    }

    public function eventsDestroy(Request $request, Event $event)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return redirect()
            ->route('admin.events.index')
            ->with('success', 'Event deleted successfully.');
    }

    public function updateVillageSuggestion(Request $request, VillageSuggestion $villageSuggestion)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $validated = $request->validate([
            'status' => ['required', 'in:pending,reviewed,in_progress,resolved'],
            'is_public' => ['nullable', 'boolean'],
        ]);

        $villageSuggestion->update([
            'status' => $validated['status'],
            'is_public' => $request->boolean('is_public'),
        ]);

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Village Voice suggestion updated successfully.');
    }

    public function destroyVillageSuggestion(Request $request, VillageSuggestion $villageSuggestion)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        $villageSuggestion->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Village suggestion deleted successfully.');
    }

    public function destroyGovernmentEmployee(Request $request, GovernmentEmployee $governmentEmployee)
    {
        if ($redirect = $this->ensureAdmin($request)) {
            return $redirect;
        }

        if ($governmentEmployee->photo) {
            Storage::disk('public')->delete($governmentEmployee->photo);
        }

        $governmentEmployee->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Employee deleted successfully.');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');

        return redirect()->route('admin.login');
    }
}
