<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransaksiTable extends Migration
{
    /**
     * untuk mendeklarasikan dan membuat table ke database
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_detail_transaksi', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('id_transaksi');
            $table->unsignedBigInteger('id_paket');
            $table->double('qty');
            $table->text('keterangan');
            $table->timestamps();

            $table->foreign('id_transaksi')->references('id')->on('tb_transaksi')->onDelete('cascade');
            $table->foreign('id_paket')->references('id')->on('tb_paket')->onDelete('cascade');
        });
    }

    /**
     * untuk me rollback agar datanya ikut kembali seperti semula
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transaksi');
    }
}