<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('government_employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('designation', 120);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('government_employees');
    }
};
