<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKruPengalamanBertugasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kru__pengalaman_bertugas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kru');
            $table->integer('id_user');
            $table->integer('id_pemeriksa');
            $table->string('jawatan_nama')->nullable();
            $table->string('nama_peperiksaan')->nullable();
            $table->string('nama_metapelajaran')->nullable();
            $table->string('tahun_mula')->nullable();
            $table->string('tahun_hingga')->nullable();
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
        Schema::dropIfExists('kru__pengalaman_bertugas');
    }
}
