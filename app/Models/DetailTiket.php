<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTiket extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'idDetailTiket',
        'tiket',
        'status',
        'ikon',
        'keterangan',
        'keteranganTambahan'
    ];

    public function tiket() {
        return $this->belongsTo(Tiket::class, 'tiket', 'idTiket');
    }

    
}
