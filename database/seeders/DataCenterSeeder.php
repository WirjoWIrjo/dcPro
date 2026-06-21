<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataCenterSeeder extends Seeder
{
    public function run(): void
    {
        // 1. dc_highlights — only seed if empty
        if (DB::table('dc_highlights')->count() === 0) {
            DB::table('dc_highlights')->insert([
                ['metric_name' => 'Uptime Reliability', 'metric_value' => '99.999%', 'icon' => 'bi-shield-check', 'is_demo' => true, 'created_at' => now(), 'updated_at' => now()],
                ['metric_name' => 'Total Power Capacity', 'metric_value' => '20 MW', 'icon' => 'bi-lightning-charge', 'is_demo' => true, 'created_at' => now(), 'updated_at' => now()],
                ['metric_name' => 'Total IT Space', 'metric_value' => '5,000 sqm', 'icon' => 'bi-building', 'is_demo' => true, 'created_at' => now(), 'updated_at' => now()],
                ['metric_name' => 'Global Compliance', 'metric_value' => '12+ Certs', 'icon' => 'bi-patch-check', 'is_demo' => true, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        // 2. facility_systems — only seed if empty
        if (DB::table('facility_systems')->count() === 0) {
            DB::table('facility_systems')->insert([
                [
                    'system_category' => 'Electrical',
                    'equipment_name' => 'Uninterruptible Power Supply (UPS)',
                    'description' => '2N redundancy with battery backup for seamless power transition.',
                    'status' => 'Active',
                    'is_demo' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'system_category' => 'Cooling',
                    'equipment_name' => 'Chiller Plant System',
                    'description' => 'Water-cooled centrifugal chillers with N+2 redundancy.',
                    'status' => 'Active',
                    'is_demo' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'system_category' => 'Security',
                    'equipment_name' => 'Biometric Access Control',
                    'description' => 'Multi-factor authentication with facial recognition and fingerprint.',
                    'status' => 'Active',
                    'is_demo' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        // 3. energy_metrics — only seed if empty
        if (DB::table('energy_metrics')->count() === 0) {
            DB::table('energy_metrics')->insert([
                ['period' => 'Q1 2026', 'pue_value' => 1.45, 'total_consumption' => 1250000, 'is_demo' => true, 'created_at' => now(), 'updated_at' => now()],
                ['period' => 'Q2 2026', 'pue_value' => 1.38, 'total_consumption' => 1180000, 'is_demo' => true, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }
    }
}
