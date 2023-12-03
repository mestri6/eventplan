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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->string('id_layanan');
            $table->string('id_user');
            $table->date('tanggal_acara');
            $table->string('alamat');
            $table->enum('status_pembayaran', ['tertunda', 'berhasil', 'gagal'])->default('tertunda');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('kode_unik')->nullable();
            $table->integer('total_pembayaran')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
