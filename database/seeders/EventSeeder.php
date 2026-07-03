<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Annual Village Meeting',
                'description' => 'Monthly meeting to discuss village development projects and community issues.',
                'event_date' => now()->addDays(7)->toDateString(),
                'location' => 'Village Panchayat Bhawan',
                'image' => 'bijrol.jpg.png',
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'title' => 'Health Camp',
                'description' => 'Free health checkup camp organized by the Primary Health Centre.',
                'event_date' => now()->addDays(14)->toDateString(),
                'location' => 'Primary Health Centre, Bijrol',
                'image' => 'h1.jpg',
                'is_featured' => false,
                'is_published' => true,
            ],
            [
                'title' => 'Cultural Program',
                'description' => 'Evening cultural program featuring local artists and traditional performances.',
                'event_date' => now()->addDays(21)->toDateString(),
                'location' => 'Community Hall',
                'image' => 'main.jpg.jpg',
                'is_featured' => true,
                'is_published' => true,
            ],
        ];

        foreach ($items as $item) {
            Event::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
