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
        Schema::create('transaksi_withdraw', function (Blueprint $table) {
            $table->id("id_withdraw");
            $table->integer("jumlah_withdraw");

            $table->foreign('id_withdraw', 'fk_id_withdraw')->references('id_transaksi')->on('transaksi')->onDelete('cascade')->onUpdate('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_withdraw');
    }
};
