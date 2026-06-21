<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = ['articles', 'products', 'galleries', 'company_profiles', 'dc_highlights', 'energy_metrics', 'facility_systems'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->boolean('is_demo')->default(false)->after('id');
            });
        }
    }

    public function down(): void
    {
        $tables = ['articles', 'products', 'galleries', 'company_profiles', 'dc_highlights', 'energy_metrics', 'facility_systems'];

        foreach ($tables as $table) {
            Schema::table($table, function (Blueprint $table) {
                $table->dropColumn('is_demo');
            });
        }
    }
};
