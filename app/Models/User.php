<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'no_wa',
        'nama_usaha',
        'foto_profile',
        'foto_ktp',
        'surat_rtrw',
        'foto_usaha',
        'password',
        'alamat',
        'status_akun',
        'alasan_penolakan',
        'id_kategori_layanan',
        'isOpen',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function kategori()
    {
        return $this->hasOne(KategoriLayanan::class, 'id_kategori_layanan', 'id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaction::class, 'users_id', 'id');
    }
}
