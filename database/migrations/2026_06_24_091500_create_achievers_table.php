<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('achievers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->string('slug', 140)->unique();
            $table->string('role', 180);
            $table->string('badge', 80)->nullable();
            $table->string('initials', 8)->nullable();
            $table->string('tone', 40)->default('service');
            $table->text('short_description')->nullable();
            $table->longText('profile_summary')->nullable();
            $table->json('journey')->nullable();
            $table->json('highlights')->nullable();
            $table->string('photo')->nullable();
            $table->string('hero_image')->nullable();
            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        $now = now();

        DB::table('achievers')->insert([
            [
                'name' => 'Puja Tomar',
                'slug' => 'puja-tomar',
                'role' => 'Mixed Martial Artist',
                'badge' => 'UFC History Maker',
                'initials' => 'PT',
                'tone' => 'athlete',
                'short_description' => 'A history-making mixed martial artist whose UFC debut win became a landmark moment for Indian combat sports and a source of pride for Bijrol.',
                'profile_summary' => 'Puja Tomar represents discipline, confidence, and the rise of Indian athletes on global combat-sports platforms. Her story is especially powerful for young girls who want to pursue sport with seriousness and courage.',
                'journey' => json_encode([
                    ['year' => 'Early Years', 'title' => 'Martial Arts Foundation', 'text' => 'Puja built her fighting base through discipline, conditioning, and years of combat-sports training.'],
                    ['year' => 'MFN', 'title' => 'Domestic MMA Success', 'text' => 'She became a major name in Indian MMA and won the Matrix Fight Night women\'s strawweight title.'],
                    ['year' => '2023', 'title' => 'UFC Signing', 'text' => 'Puja signed with the Ultimate Fighting Championship, opening a historic path for Indian women in global MMA.'],
                    ['year' => '2024', 'title' => 'First Indian UFC Bout Win', 'text' => 'She won her UFC debut by split decision, becoming the first Indian fighter to win a UFC bout.'],
                ]),
                'highlights' => json_encode([
                    'First Indian fighter to win a UFC bout',
                    'Matrix Fight Night women\'s strawweight champion',
                    'Symbol of courage for young athletes',
                    'A proud name connected with Bijrol village',
                ]),
                'display_order' => 1,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Sumit Tomar',
                'slug' => 'sumit-tomar',
                'role' => 'Guinness World Record Holder | Indian Army',
                'badge' => 'World Record',
                'initials' => 'ST',
                'tone' => 'service',
                'short_description' => 'A Guinness World Record holder from Bijrol, known for an extraordinary no-hands motorcycle wheelie and the discipline of Indian Army training.',
                'profile_summary' => 'Sumit Tomar has become a proud name for Bijrol and Baghpat through a rare display of balance, courage, and technical control. His record reflects the focus and discipline required for high-risk motorcycle stunt riding.',
                'journey' => json_encode([
                    ['year' => 'Bijrol', 'title' => 'Village Roots', 'text' => 'Sumit Tomar comes from Bijrol village in Baghpat district, Uttar Pradesh, carrying a legacy of courage and discipline.'],
                    ['year' => 'Army', 'title' => 'Service And Training', 'text' => 'His journey is connected with the Indian Army and the high-skill motorcycle display culture of the ASC Tornadoes.'],
                    ['year' => 'Dec 2024', 'title' => 'World Record Attempt', 'text' => 'He attempted the longest no-hands motorcycle wheelie on the Bengaluru-Chennai Expressway.'],
                    ['year' => 'Record', 'title' => 'Guinness Recognition', 'text' => 'The feat covered around 1,700 meters, surpassing the earlier record and bringing attention to Bijrol and Baghpat.'],
                ]),
                'highlights' => json_encode([
                    'Guinness World Record for no-hands motorcycle wheelie',
                    'Around 1,700 meters covered on one rear wheel',
                    'Connected with Indian Army discipline and stunt-riding training',
                    'A proud name from Bijrol village, Baghpat',
                ]),
                'display_order' => 2,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('achievers');
    }
};
