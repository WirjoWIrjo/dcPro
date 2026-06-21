<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        Article::firstOrCreate(
            ['slug' => Str::slug('Optimasi PUE di Data Center Skala Besar')],
            [
                'title' => 'Optimasi PUE di Data Center Skala Besar',
                'category' => 'Engineering',
                'excerpt' => 'Bagaimana tim engineering kami berhasil menurunkan angka Power Usage Effectiveness melalui sistem cooling modern.',
                'content' => 'Isi konten lengkap mengenai strategi optimasi energi...',
                'image' => null,
                'is_demo' => false,
            ]
        );

        Article::firstOrCreate(
            ['slug' => Str::slug('Standarisasi Tier IV untuk Keamanan Data')],
            [
                'title' => 'Standarisasi Tier IV untuk Keamanan Data',
                'category' => 'Infrastructure',
                'excerpt' => 'Mengenal protokol redundansi yang menjamin ketersediaan layanan 99.999% bagi infrastruktur digital.',
                'content' => 'Penjelasan mendalam mengenai infrastruktur Tier IV...',
                'image' => null,
                'is_demo' => false,
            ]
        );
    }
}
