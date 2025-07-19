<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'id_program',
        'nama_kelas',
    ];

    // Jika Anda ingin menetapkan relasi dengan tabel ProgramAkademik
    public function programAkademik()
    {
        return $this->belongsTo(ProgramAkademik::class, 'id_program');
    }
}
