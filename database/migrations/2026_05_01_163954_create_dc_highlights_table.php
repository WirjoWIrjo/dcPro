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
    Schema::create('dc_highlights', function (Blueprint $table) {
        $table->id();
        $table->string('metric_name');  // Example: Uptime
        $table->string('metric_value'); // Example: 99.999%
        $table->string('icon');         // Example: bi-cpu
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dc_highlights');
    }
};
