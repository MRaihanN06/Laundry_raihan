<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaketTable extends Migration
{
    /**
     * untuk mendeklarasikan dan membuat table ke database
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_paket', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('id_outlet');
            $table->enum('jenis', [
                'kiloan', 'selimut', 'bed_cover', 'kaos', 'lain'
            ]);
            $table->string('nama_paket', 100);
            $table->integer('harga');
            $table->timestamps();

            $table->foreign('id_outlet')->references('id')->on('tb_outlet')->onDelete('cascade');
        });
    }

    /**
     * untuk me rollback agar datanya ikut kembali seperti semula
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('paket');
    }
}