<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GaleryLayanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'galeri_layanan';
    protected $primaryKey = 'id_galeri_layanan';

    protected $guarded = [
        'id_galeri_layanan',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'id_layanan', 'id_layanan');
    }
}
