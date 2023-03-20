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
        Schema::create('perusahaan__daftar__events', function (Blueprint $table) {
            $table->id();
             $table->foreignId('id_perusahaan')->references('id')->on('perusahaans');
            // $table->foreignId('id_event')->references('id')->on('events');
            $table->string('nama_pic');
            $table->string('jabatan_pic');
            $table->string('persetujuan');
             $table->text('alasan_ditolak');
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
        Schema::dropIfExists('perusahaan__daftar__events');
    }
};
