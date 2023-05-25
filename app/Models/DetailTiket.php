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

    // protected $with = ['Tiket'];

    public function tiket() {
        return $this->belongsTo(Tiket::class, 'tiket', 'idTiket');
    }

    
}
