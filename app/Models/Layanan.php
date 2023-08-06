<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'layanans';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    public function galery()
    {
        return $this->hasMany(GaleryLayanan::class, 'layanan_id', 'id');
    }
}
