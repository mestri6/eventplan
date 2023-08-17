<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'carts';
    protected $primaryKey = 'id';

    protected $guarded = [
        'id',
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'carts_id', 'id');
    }
}
