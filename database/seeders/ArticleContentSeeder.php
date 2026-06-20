<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleContentSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'id' => 1,
                'content' => "Power Usage Effectiveness (PUE) adalah metrik utama yang digunakan untuk mengukur efisiensi energi di sebuah data center. PUE dihitung dari rasio total energi yang masuk ke fasilitas dengan energi yang benar-benar digunakan oleh perangkat IT.\n\nDi DataCenterPro, kami berhasil menurunkan angka PUE dari 1.52 menjadi 1.38 dalam kurun waktu 18 bulan melalui beberapa strategi berikut:\n\n1. Optimasi Sistem Cooling\nKami mengganti sistem pendingin konvensional dengan teknologi Free Cooling yang memanfaatkan suhu udara luar. Chiller plant yang ada dikonfigurasi ulang dengan setpoint suhu yang lebih tinggi (18C dari sebelumnya 14C), sehingga kompresor tidak perlu bekerja terlalu keras.\n\n2. Hot Aisle Containment\nPemasangan containment pada hot aisle mencegah pencampuran udara panas dan dingin. Hal ini meningkatkan efisiensi pengembalian udara panas ke CRAC unit hingga 35%.\n\n3. Manajemen Suhu Ruangan\nPenerapan dynamic thermal management memungkinkan penyesuaian distribusi pendingin berdasarkan beban IT real-time. Rack yang tidak aktif mendapat pasokan udara pendingin lebih sedikit.\n\n4. Pemeliharaan Preventif\nScheduled maintenance dilakukan setiap bulan pada seluruh komponen HVAC. Filter dibersihkan mingguan, dan refrigerant dicek secara berkala untuk memastikan performa optimal.\n\nHasil dari optimasi ini adalah penghematan biaya energi sekitar Rp 2.4 Miliar per tahun dan pengurangan emisi karbon sebesar 15%. Angka PUE 1.38 kami sejajar dengan standar data center tier-3 global yang rata-rata berada di kisaran 1.4-1.6.",
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'content' => "Tier IV merupakan standar tertinggi dalam klasifikasi data center menurut Uptime Institute. Data center tier ini menjamin availability 99.999% atau maximal downtime hanya 26.3 menit per tahun.\n\nBerikut adalah komponen-komponen kritis yang harus dipenuhi untuk sertifikasi Tier IV di DataCenterPro:\n\n1. Redundansi 2N (Double-End)\nSeluruh komponen infrastruktur kritikal memiliki redundansi penuh 2N. Artinya, setiap sistem memiliki pasangan identik yang mampu menanggung seluruh beban secara mandiri. Jika satu UPS gagal, UPS kedua akan mengambil alih tanpa interupsi.\n\n2. Fault Tolerance\nDesain fault tolerant memastikan bahwa kegagalan satu komponen tidak akan mempengaruhi operasional keseluruhan. Sistem distribusi listrik menggunakan dual-path dengan automatic transfer switch (ATS) yang beroperasi dalam hitungan milidetik.\n\n3. Modular Expansion\nArsitektur modular memungkinkan penambahan kapasitas tanpa downtime. Setiap module dirancang untuk beroperasi secara independen, sehingga maintenance atau upgrade dapat dilakukan tanpa mempengaruhi module lainnya.\n\n4. Security Multi-Layer\nAkses ke area kritis dilindungi oleh empat lapis keamanan: perimeter fence dengan CCTV, pintu masuk utama dengan access card, biometric verification di corridor dalam, dan rack-level lock untuk setiap cabinet.\n\n5. Disaster Recovery\nDataCenterPro memiliki backup facility yang berlokasi 50km dari site utama. Recovery Time Objective (RTO) ditargetkan kurang dari 15 menit dengan Recovery Point Objective (RPO) nol data loss.\n\nSertifikasi Tier IV tidak hanya soal infrastruktur, tetapi juga prosedur operasional. Tim kami menjalankan standardized operating procedure (SOP) yang diaudit setiap 6 bulan untuk memastikan kepatuhan berkelanjutan.",
                'updated_at' => now(),
            ],
        ];

        foreach ($articles as $article) {
            DB::table('articles')->where('id', $article['id'])->update([
                'content' => $article['content'],
                'updated_at' => $article['updated_at'],
            ]);
        }
    }
}
