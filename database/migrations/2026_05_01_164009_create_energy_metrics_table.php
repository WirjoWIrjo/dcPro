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
    Schema::create('energy_metrics', function (Blueprint $table) {
        $table->id();
        $table->string('period');          // Example: Mei 2026
        $table->decimal('pue_value', 4, 2); // Example: 1.25
        $table->integer('total_consumption'); // kWh
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('energy_metrics');
    }
};
