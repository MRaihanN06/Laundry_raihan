<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePebarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pebarang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nama_barang', 100);
            $table->datetime('waktu_pakai');
            $table->datetime('waktu_beres')->nullable();
            $table->string('nama_pemakai', 100);
            $table->enum('pestatus', [
                'selesai', 'belum_selesai'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pebarang');
    }
}
