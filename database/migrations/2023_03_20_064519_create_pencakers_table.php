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
        Schema::create('pencakers', function (Blueprint $table) {
            $table->id();
             $table->foreignId('id_user')->references('id')->on('users');
            $table->foreignId('id_provinsi')->references('id')->on('provinsis');
            $table->string('nama');
            $table->date('tangal_lahir');
            $table->string('jenis_kelamin');
            $table->string('telpon');
            $table->string('ktp');
            $table->string('disabilitas');  //disuruh buat table baru
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
        Schema::dropIfExists('pencakers');
    }
};
