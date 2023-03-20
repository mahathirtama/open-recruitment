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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
             $table->foreignId('id_perusahaan_daftar_events')->references('id')->on('perusahaan__daftar__events');
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('alamat');
            $table->date('waktu_mulai');
            $table->date('waktu_berakhir');
            $table->string('status');
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
        Schema::dropIfExists('events');
    }
};
