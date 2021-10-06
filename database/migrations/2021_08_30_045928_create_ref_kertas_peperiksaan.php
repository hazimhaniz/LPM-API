<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefKertasPeperiksaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_kertas_peperiksaan', function (Blueprint $table) {
            $table->id();
            $table->string('id_mata_pelajaran');
            $table->string('no_kertas_peperiksaan');
            $table->string('kod_kertas_peperiksaan');
            $table->string('nama_kertas_peperiksaan');
            $table->string('markah_maksimum_kertas');
            $table->string('skala_kertas');
            $table->json('masa_peperiksaan_kertas');
            $table->json('calon');
            $table->string('catatan_kertas');
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
        Schema::dropIfExists('ref_kertas_peperiksaan');
    }
}
