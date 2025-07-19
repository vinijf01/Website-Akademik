<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_santri',
        'semester',
        'file_raport',
    ];

    // Relasi dengan tabel  (santri)
    public function Santri()
    {
        return $this->belongsTo(Santri::class, 'id_santri', 'id_santri');
    }
}
