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
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
             $table->foreignId('id_user')->references('id')->on('users');
            $table->foreignId('id_bidang')->references('id')->on('bidangs');
            $table->foreignId('id_provinsi')->references('id')->on('provinsis');
            $table->string('nama_perushaan');
            $table->text('alamat');
            $table->string('website');
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
        Schema::dropIfExists('perusahaans');
    }
};
