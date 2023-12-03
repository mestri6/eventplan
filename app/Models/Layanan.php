<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Layanan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';

    protected $guarded = [
        'id_layanan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function galleries()
    {
        return $this->hasMany(GaleryLayanan::class, 'id_galeri_layanan', 'id_layanan');
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'id_layanan', 'id');
    }
}
