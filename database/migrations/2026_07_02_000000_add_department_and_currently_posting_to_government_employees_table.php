<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('government_employees', function (Blueprint $table) {
            $table->string('department', 140)->nullable()->after('name');
            $table->string('currently_posting', 160)->nullable()->after('designation');
        });
    }

    public function down(): void
    {
        Schema::table('government_employees', function (Blueprint $table) {
            $table->dropColumn(['department', 'currently_posting']);
        });
    }
};
