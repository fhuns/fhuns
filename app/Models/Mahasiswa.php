<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['nama', 'nim', 'angkatan', 'prodi', 'tahun'];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->tahun = $model->tahun ?? date('Y');
        });
    }
}