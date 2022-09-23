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
        Schema::create('barang', function (Blueprint $table) {
            $table->id('id_barang');
            $table->string('nama_barang');
            $table->integer('harga');
            $table->string('foto');
            $table->string('deskripsi');
            $table->integer('stok');
            $table->unsignedBigInteger('id_kategori');
            $table->char('id_siswa_penjual', 6);
            $table->timestamps();

            $table->foreign('id_kategori', 'fk_id_kategori')->references('id_kategori')->on('kategori');
            $table->foreign('id_siswa_penjual', 'fk_siswa_penjual')->references('id_siswa')->on('siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
};
