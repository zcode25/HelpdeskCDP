<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    // protected $primaryKey = 'noTiket';
    protected $fillable = [
        'idTiket',
        'noTiket',
        'user',
        'teknisi',
        'permintaan',
        'uraianPermintaan',
        'ekspetasiSelesai',
        'prioritas',
        'status',

    ];

    public function detailTiket() {
        return $this->hasMany(DetailTiket::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'user', 'nik');
    }

    public function teknisi() {
        return $this->belongsTo(User::class, 'teknisi', 'nik');
    }
}
