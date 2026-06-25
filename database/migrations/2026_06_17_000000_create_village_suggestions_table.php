<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('village_suggestions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('category', 80);
            $table->string('area', 120)->nullable();
            $table->string('title', 160);
            $table->text('message');
            $table->boolean('is_public')->default(true);
            $table->string('status', 30)->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('village_suggestions');
    }
};
