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
    Schema::create('facility_systems', function (Blueprint $table) {
        $table->id();
        $table->string('system_category'); // Electrical / Cooling / Security
        $table->string('equipment_name');  // UPS, Chiller, Biometric
        $table->text('description');       // Detail teknis
        $table->string('status')->default('Active');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_systems');
    }
};
