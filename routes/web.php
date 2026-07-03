<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Models\GovernmentEmployee;
use App\Models\Achiever;
use App\Models\VillageSuggestion;
use App\Models\News;
use App\Models\Event;
use App\Models\Clinic;
use App\Services\EGramSwarajDashboardService;
use Illuminate\Http\Request;

// Home page
Route::get('/', function () {
    // Sample featured posts
    $featuredPosts = [
        (object)[
            'id' => 1,
            'title' => 'Bijrol Village Festival 2026',
            'excerpt' => 'Join us for the annual village festival with cultural performances, food stalls, and traditional games.',
            'category' => 'Events',
            'image' => 'vil.jpg.png',
            'created_at' => now()->subDays(2)
        ],
        (object)[
            'id' => 2,
            'title' => 'New School Building Inauguration',
            'excerpt' => 'The new primary school building was inaugurated with modern facilities for our children.',
            'category' => 'Development',
            'image' => 'bijrol.jpg.png',
            'created_at' => now()->subDays(5)
        ],
        (object)[
            'id' => 3,
            'title' => 'Agriculture Workshop Success',
            'excerpt' => 'Recent workshop on modern farming techniques attracted over 100 farmers from the village.',
            'category' => 'Agriculture',
            'image' => 'vil.jpg.png',
            'created_at' => now()->subDays(7)
        ]
    ];

    // Sample recent posts
    $recentPosts = [
        (object)[
            'id' => 4,
            'title' => 'Village Cleanup Drive',
            'excerpt' => 'Community comes together to clean and beautify public spaces.',
            'image' => 'bijrol.jpg.png',
            'created_at' => now()->subDays(1)
        ],
        (object)[
            'id' => 5,
            'title' => 'New Water Supply System',
            'excerpt' => 'Improved water supply system now serving all households.',
            'image' => 'vil.jpg.png',
            'created_at' => now()->subDays(3)
        ],
        (object)[
            'id' => 6,
            'title' => 'Sports Tournament Results',
            'excerpt' => 'Annual village sports tournament concludes with exciting matches.',
            'image' => 'bijrol.jpg.png',
            'created_at' => now()->subDays(4)
        ],
        (object)[
            'id' => 7,
            'title' => 'Elderly Care Program',
            'excerpt' => 'New initiative launched to support senior citizens in the village.',
            'image' => 'vil.jpg.png',
            'created_at' => now()->subDays(6)
        ],
        (object)[
            'id' => 8,
            'title' => 'Library Renovation Complete',
            'excerpt' => 'Village library reopens with new books and reading space.',
            'image' => 'bijrol.jpg.png',
            'created_at' => now()->subDays(8)
        ],
        (object)[
            'id' => 9,
            'title' => 'Harvest Festival Preparations',
            'excerpt' => 'Planning begins for the upcoming harvest festival celebrations.',
            'image' => 'vil.jpg.png',
            'created_at' => now()->subDays(9)
        ]
    ];

    return view('home', [
        'featuredPosts' => $featuredPosts,
        'recentPosts' => $recentPosts,
        'latestNews' => News::where('is_published', true)->latest()->take(4)->get(),
        'upcomingEvents' => Event::where('is_published', true)->where('event_date', '>=', now()->toDateString())->latest()->take(4)->get(),
        'latestAnnouncements' => News::where('is_published', true)->latest()->take(3)->get(),
    ]);
});

// About page
Route::get('/about', function () {
    return view('about');
});

// Gallery page
Route::get('/gallery', function () {
    return view('gallery');
});

// Schools page
Route::get('/schools', function () {
    return view('schools');
});

// Temples page
Route::get('/temples', function () {
    return view('temples');
});

// Sport Ground page
Route::get('/sport-ground', function () {
    return view('sport-ground');
});

// Hospitals page
Route::get('/hospitals', function () {
    return view('hospitals', [
        'clinics' => Clinic::where('is_published', true)
            ->orderBy('display_order')
            ->orderBy('name')
            ->get(),
    ]);
});

// Contact page
Route::get('/contact', function () {
    return view('contact');
});

// Village Voice page
Route::get('/village-voice', function () {
    return view('village-voice', [
        'publicSuggestions' => VillageSuggestion::where('is_public', true)->latest()->take(12)->get(),
        'totalSuggestions' => VillageSuggestion::count(),
    ]);
})->name('village-voice.index');

Route::post('/village-voice', function (Request $request) {
    $validated = $request->validate([
        'name' => ['nullable', 'string', 'max:100'],
        'phone' => ['nullable', 'string', 'max:20'],
        'category' => ['required', 'string', 'max:80'],
        'area' => ['nullable', 'string', 'max:120'],
        'title' => ['required', 'string', 'max:160'],
        'message' => ['required', 'string', 'max:3000'],
        'is_public' => ['nullable', 'boolean'],
    ]);

    $validated['is_public'] = $request->boolean('is_public');
    $validated['status'] = 'pending';

    VillageSuggestion::create($validated);

    return redirect()
        ->route('village-voice.index')
        ->with('success', 'Aapka sujhav submit ho gaya hai. Dhanyavaad!');
})->name('village-voice.store');

// Who's Who page
Route::get('/whos-who', function () {
    return view('whos-who', [
        'profiles' => Achiever::where('is_published', true)
            ->orderBy('display_order')
            ->orderBy('name')
            ->get(),
    ]);
})->name('whos-who');

// Government Employees page
Route::get('/government-employees', function () {
    return view('government-employees', [
        'employees' => GovernmentEmployee::latest()->get(),
    ]);
})->name('government-employees.index');

Route::post('/government-employees', function (Request $request) {
    $validated = $request->validate([
        'name' => ['required', 'string', 'max:100'],
        'department' => ['nullable', 'string', 'max:140'],
        'designation' => ['required', 'string', 'max:120'],
        'currently_posting' => ['nullable', 'string', 'max:160'],
        'photo' => ['nullable', 'image', 'max:2048'],
    ]);

    $data = [
        'name' => $validated['name'],
        'department' => $validated['department'] ?? null,
        'designation' => $validated['designation'],
        'currently_posting' => $validated['currently_posting'] ?? null,
    ];

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('employee-photos', 'public');
    }

    GovernmentEmployee::create($data);

    return redirect()
        ->route('government-employees.index')
        ->with('success', 'Employee information added successfully.');
})->name('government-employees.store');

// Admin Routes
Route::post('/admin/login', [AdminController::class, 'authenticate']);
Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/forgot-password', [AdminController::class, 'forgotPassword'])->name('admin.password.request');
Route::post('/admin/forgot-password', [AdminController::class, 'sendPasswordHelp'])->name('admin.password.email');
Route::get('/admin/reset-password/{token}', [AdminController::class, 'resetPassword'])->name('admin.password.reset');
Route::post('/admin/reset-password', [AdminController::class, 'updatePassword'])->name('admin.password.update');
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::delete('/admin/government-employees/{governmentEmployee}', [AdminController::class, 'destroyGovernmentEmployee'])
    ->name('admin.government-employees.destroy');
Route::patch('/admin/village-suggestions/{villageSuggestion}', [AdminController::class, 'updateVillageSuggestion'])
    ->name('admin.village-suggestions.update');
Route::delete('/admin/village-suggestions/{villageSuggestion}', [AdminController::class, 'destroyVillageSuggestion'])
    ->name('admin.village-suggestions.destroy');
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Admin News Management
Route::get('/admin/news', [AdminController::class, 'newsIndex'])->name('admin.news.index');
Route::get('/admin/news/create', [AdminController::class, 'newsCreate'])->name('admin.news.create');
Route::post('/admin/news', [AdminController::class, 'newsStore'])->name('admin.news.store');
Route::get('/admin/news/{news}/edit', [AdminController::class, 'newsEdit'])->name('admin.news.edit');
Route::put('/admin/news/{news}', [AdminController::class, 'newsUpdate'])->name('admin.news.update');
Route::delete('/admin/news/{news}', [AdminController::class, 'newsDestroy'])->name('admin.news.destroy');

// Admin Events Management
Route::get('/admin/events', [AdminController::class, 'eventsIndex'])->name('admin.events.index');
Route::get('/admin/events/create', [AdminController::class, 'eventsCreate'])->name('admin.events.create');
Route::post('/admin/events', [AdminController::class, 'eventsStore'])->name('admin.events.store');
Route::get('/admin/events/{event}/edit', [AdminController::class, 'eventsEdit'])->name('admin.events.edit');
Route::put('/admin/events/{event}', [AdminController::class, 'eventsUpdate'])->name('admin.events.update');
Route::delete('/admin/events/{event}', [AdminController::class, 'eventsDestroy'])->name('admin.events.destroy');

// Admin Clinics Management
Route::get('/admin/clinics', [AdminController::class, 'clinicsIndex'])->name('admin.clinics.index');
Route::get('/admin/clinics/create', [AdminController::class, 'clinicsCreate'])->name('admin.clinics.create');
Route::post('/admin/clinics', [AdminController::class, 'clinicsStore'])->name('admin.clinics.store');
Route::get('/admin/clinics/{clinic}/edit', [AdminController::class, 'clinicsEdit'])->name('admin.clinics.edit');
Route::put('/admin/clinics/{clinic}', [AdminController::class, 'clinicsUpdate'])->name('admin.clinics.update');
Route::delete('/admin/clinics/{clinic}', [AdminController::class, 'clinicsDestroy'])->name('admin.clinics.destroy');

// Admin Who's Who Management
Route::get('/admin/achievers', [AdminController::class, 'achieversIndex'])->name('admin.achievers.index');
Route::get('/admin/achievers/create', [AdminController::class, 'achieversCreate'])->name('admin.achievers.create');
Route::post('/admin/achievers', [AdminController::class, 'achieversStore'])->name('admin.achievers.store');
Route::get('/admin/achievers/{achiever}/edit', [AdminController::class, 'achieversEdit'])->name('admin.achievers.edit');
Route::put('/admin/achievers/{achiever}', [AdminController::class, 'achieversUpdate'])->name('admin.achievers.update');
Route::delete('/admin/achievers/{achiever}', [AdminController::class, 'achieversDestroy'])->name('admin.achievers.destroy');

// Gram Panchayat Dashboard
Route::get('/panchayat-dashboard', function () {
    return view('panchayat-dashboard');
})->name('panchayat.dashboard');

Route::get('/api/dashboard', function (Request $request, EGramSwarajDashboardService $dashboardService) {
    return response()->json($dashboardService->dashboard($request->boolean('refresh')));
})->name('api.panchayat.dashboard');

Route::get('/{achiever:slug}', function (Achiever $achiever) {
    abort_unless($achiever->is_published, 404);

    return view('achiever-profile', compact('achiever'));
})->name('achievers.show');
