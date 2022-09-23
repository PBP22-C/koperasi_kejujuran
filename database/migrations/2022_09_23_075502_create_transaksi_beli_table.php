<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_beli', function (Blueprint $table) {
            $table->id('id_beli');
            $table->unsignedBigInteger('id_barang');
            $table->integer('kuantitas');
            $table->integer('harga_total');

            $table->foreign('id_beli', 'fk_id_beli')->references('id_transaksi')->on('transaksi');
            $table->foreign('id_barang', 'fk_id_barang')->references('id_barang')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_belis');
    }
};
