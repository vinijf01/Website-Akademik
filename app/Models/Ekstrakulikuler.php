<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekstrakulikuler extends Model
{
    use HasFactory;
    protected $table = 'ekstrakulikuler';
    protected $fillable = ['nama_ekstrakulikuler', 'waktu_per_minggu', 'jam_per_periode', 'image'];
}
