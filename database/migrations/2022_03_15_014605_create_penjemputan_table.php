<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjemputanTable extends Migration
{
    /**
     * untuk mendeklarasikan dan membuat table ke database
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_penjemputan', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('id_member');
            $table->unsignedBigInteger('id_user');
            $table->enum('status', ['tercatat', 'penjemputan', 'selesai']);
            $table->timestamps();

            $table->foreign('id_member')->references('id')->on('tb_member')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * untuk me rollback agar datanya ikut kembali seperti semula
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penjemputan');
    }
}
