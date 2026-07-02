<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('doctor_name')->nullable();
            $table->string('clinic_type')->nullable();
            $table->string('location');
            $table->string('phone')->nullable();
            $table->string('timing')->nullable();
            $table->text('services')->nullable();
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
