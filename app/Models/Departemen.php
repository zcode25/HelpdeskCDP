<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $fillable = [
        'kodeDepartemen',
        'namaDepartemen',
    ];

    // protected $primaryKey = 'kodeDepartemen';

    public function user() {
        return $this->hasMany(User::class);
    }
}
