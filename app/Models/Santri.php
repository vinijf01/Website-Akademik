<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    use HasFactory;
    protected $table = 'santri';

    protected $fillable = [
        'id_program',
        'nama_lengkap',
        'jenis_kelamin',
        'no_wa',
        'usia',
        'sk_sekolah',
        'kk',
        'akta',
        'ktp',
        'pasphoto',
        'raport',
        'status',
        'TA',
        'id_santri',
        'id_kelas',
    ];

    public function programAkademik()
    {
        return $this->belongsTo(ProgramAkademik::class, 'id_program');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas'); // Menambahkan relasi ke Kelas
    }
}
