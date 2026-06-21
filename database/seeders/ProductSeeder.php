<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('products')->count() === 0) {
            DB::table('products')->insert([
                [
                    'name' => 'UPS 3-Phase 500kVA',
                    'slug' => 'ups-3-phase-500kva',
                    'description' => 'Uninterruptible Power Supply 3-phase dengan kapasitas 500kVA. Menggunakan teknologi double-conversion online yang menjamin pasokan listrik tanpa interupsi. Dilengkapi battery backup hingga 15 menit pada beban penuh, serta SNMP card untuk monitoring remote. Cocok untuk data center tier-2 dan tier-3.',
                    'price' => 850000000,
                    'category' => 'Electrical',
                    'image' => null,
                    'status' => 'active',
                    'is_demo' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'InRow Chiller 35kW',
                    'slug' => 'inrow-chiller-35kw',
                    'description' => 'Sistem pendingin InRow dengan kapasitas 35kW yang dirancang khusus untuk high-density rack. Unit ini ditempatkan di antara barisan rack untuk pendinginan langsung yang efisien. Dilengkapi variable speed compressor dan EC fan yang menghemat energi hingga 40% dibandingkan sistem konvensional.',
                    'price' => 320000000,
                    'category' => 'Cooling',
                    'image' => null,
                    'status' => 'active',
                    'is_demo' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Rack Cabinet 42U 800mm',
                    'slug' => 'rack-cabinet-42u-800mm',
                    'description' => 'Server rack standar 42U dengan kedalaman 1000mm dan lebar 800mm. Terbuat dari baja berkualitas tinggi dengan beban maksimal 800kg. Dilengkapi pintu perforated untuk aliran udara optimal, kabel management vertikal dan horizontal, serta penguncian ganda untuk keamanan.',
                    'price' => 12500000,
                    'category' => 'Infrastructure',
                    'image' => null,
                    'status' => 'active',
                    'is_demo' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'Biometric Access Control System',
                    'slug' => 'biometric-access-control',
                    'description' => 'Sistem kontrol akses multi-faktor dengan kombinasi fingerprint scanner dan facial recognition. Kapasitas hingga 10.000 user dengan waktu verifikasi kurang dari 1 detik. Terintegrasi dengan CCTV dan logging system untuk audit trail lengkap. Tahan debu dan cocok untuk lingkungan data center.',
                    'price' => 45000000,
                    'category' => 'Security',
                    'image' => null,
                    'status' => 'active',
                    'is_demo' => false,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
