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
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
             $table->foreignId('id_perusahaan')->references('id')->on('perusahaans');
            $table->foreignId('id_perusahaan_daftar_event')->references('id')->on('perusahaan__daftar__events');
            $table->string('posisi');
            $table->unsignedInteger('kuota');
            $table->string('tugas');
            $table->unsignedInteger('gaji');
            $table->string('fasilitas');
            $table->text('deskripsi');
            $table->string('jenis_kelamin');
            $table->integer('usia_minimal');
            $table->integer('usai_maximal');
            $table->string('kualifikasi');
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
        Schema::dropIfExists('lowongans');
    }
};
