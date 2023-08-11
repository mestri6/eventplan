<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KategoriLayanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'galery_layanans';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];
}
