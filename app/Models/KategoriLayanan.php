<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriLayanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_layanan';
    protected $primaryKey = 'id_kategori_layanan';

    protected $guarded = [
        'id_kategori_layanan',
    ];
}
