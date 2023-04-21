<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTiket extends Model
{
    use HasFactory;

    public function tiket() {
        return $this->belongsTo(Tiket::class, 'tiket', 'noTiket');
    }

    
}
