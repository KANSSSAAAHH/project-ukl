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
        Schema::create('pesanan', function (Blueprint $table) {

            $table->id('id_pesanan');

            $table->unsignedBigInteger('id_user');

            $table->date('tanggal_pesanan');

            $table->integer('total_harga');

            $table->enum('status_pesanan', ['menunggu','diproses','selesai']);

            $table->foreign('id_user')
                  ->references('id_user')
                  ->on('users')
                  ->onDelete('cascade');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};