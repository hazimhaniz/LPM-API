<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefKeyJawapanMataPelajaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_key_jawapan_mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peperiksaan');
            $table->unsignedBigInteger('id_tahun_peperiksaan');
            $table->unsignedBigInteger('id_mata_pelajaran');
            $table->unsignedBigInteger('id_kertas_peperiksaan');
            $table->unsignedBigInteger('id_jadual_peperiksaan')->nullable();
            $table->unsignedBigInteger('id_gred')->nullable();
            $table->json('key_jawapan')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Foreign key
            $table->foreign('id_peperiksaan')->references('id')->on('peperiksaan');
            $table->foreign('id_tahun_peperiksaan')->references('id')->on('peperiksaan__tahun_peperiksaan');
            $table->foreign('id_mata_pelajaran')->references('id')->on('ref_peperiksaan__kod_mata_pelajaran');
            $table->foreign('id_kertas_peperiksaan')->references('id')->on('ref_kertas_peperiksaan');
            $table->foreign('id_jadual_peperiksaan')->references('id')->on('peperiksaan__jadual_peperiksaan');
            $table->foreign('id_gred')->references('id')->on('ref_gred_mata_pelajaran');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_key_jawapan_mata_pelajaran');
    }
}
