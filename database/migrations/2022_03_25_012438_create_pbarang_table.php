<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePbarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pbarang', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nama_barang', 100);
            $table->integer('qty');
            $table->integer('harga');
            $table->datetime('waktu_beli');
            $table->string('supplier', 100);
            $table->enum('bstatus', [
                'diajukan_beli', 'habis', 'tersedia'
            ]);
            $table->datetime('tgl_status')->nullable();
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
        Schema::dropIfExists('pbarang');
    }
}
