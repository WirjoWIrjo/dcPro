<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- TAMBAHKAN BARIS INI

class Projects extends Model
{
    use HasFactory;

    // Perbaiki 'Protected' menjadi 'protected'
    protected $fillable = [
        "title",
        "description",
        "teknologi",
        "image",
        "status",
    ];

}
