<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->default('Customer');
            $table->string('email')->unique();
            $table->string('no_wa')->nullable();
            $table->string('nama_usaha')->nullable();
            $table->string('foto_profile')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_usaha')->nullable();
            $table->text('alamat')->nullable();
            $table->string('status_akun')->nullable();
            $table->string('id_kategori_layanan')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
