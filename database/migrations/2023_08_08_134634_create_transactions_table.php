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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('carts_id');
            $table->date('tanggal_acara');
            $table->string('alamat');
            $table->enum('status_pembayaran', ['pending', 'success', 'failed']);
            $table->enum('type_pembayaran', ['DP', 'Lunas']);
            $table->string('bukti_pembayaran')->nullable();
            $table->integer('is_dp')->nullable();
            $table->integer('is_lunas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
