<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaTable extends Migration
{
    /**
     * untuk me rollback agar datanya ikut kembali seperti semula
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pengguna', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nama', 100);
            $table->string('username', 30);
            $table->text('password');
            $table->unsignedBigInteger('id_outlet');
            $table->enum('role', [
                'admin', 'kasir', 'owner'
            ]);
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
        Schema::dropIfExists('pengguna');
    }
}