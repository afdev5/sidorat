<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('no_agenda')->unique()->nullable();
            $table->string('indeks');
            $table->text('masalah');
            $table->date('tgl_pelaksana');
            $table->enum('jenis',['0','1','2']); // 0 = Biasa, 1 = Penting, 2 = Rahasia
            $table->text('instruksi')->nullable();
            $table->string('asal_surat')->nullable();
            $table->string('nomor')->nullable();
            $table->integer('user_tujuan')->unsigned();
            $table->foreign('user_tujuan')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('surats');
    }
}
