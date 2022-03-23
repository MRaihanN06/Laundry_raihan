<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutletTable extends Migration
{
    /**
     * untuk mendeklarasikan dan membuat table ke database
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_outlet', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nama', 100);
            $table->text('alamat');
            $table->string('tlp', 20);
            $table->timestamps();
        });
    }

    /**
     * untuk me rollback agar datanya ikut kembali seperti semula
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('outlet');
    }
}