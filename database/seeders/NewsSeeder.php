<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'title' => 'Bijrol Village Website Launched',
                'excerpt' => 'A new digital gateway for Bijrol village is now live, offering information on history, education, healthcare, and more.',
                'content' => 'The BIJROL Village website has been officially launched. Residents can now access history, education, healthcare, government services, gallery, and leadership information in one place.',
                'image' => 'bijrol.jpg.png',
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],
            [
                'title' => 'Village Voice Feature Added',
                'excerpt' => 'Residents can now submit suggestions and problems directly through the Village Voice section.',
                'content' => 'The new Village Voice section allows residents to share problems, ideas, and suggestions for village development. All submissions are reviewed by the admin team.',
                'image' => 'vil.jpg.png',
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],
            [
                'title' => 'Upcoming Harvest Festival Preparations',
                'excerpt' => 'Preparations begin for the annual harvest festival celebrations in Bijrol.',
                'content' => 'Community members are coming together to organize the annual harvest festival. Events include cultural performances, local food stalls, and traditional competitions.',
                'image' => 'main.jpg.jpg',
                'is_published' => true,
                'published_at' => now()->subDays(1),
            ],
        ];

        foreach ($items as $item) {
            News::updateOrCreate(
                ['title' => $item['title']],
                $item
            );
        }
    }
}
