<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanTahunanAlumni extends Model
{
    use HasFactory;

    protected $table = 'laporan_tahunan_alumni';

    protected $fillable = [
        'T_A',
        'laporan',
    ];
}
