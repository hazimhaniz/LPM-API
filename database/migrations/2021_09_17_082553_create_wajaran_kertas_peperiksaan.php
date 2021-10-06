<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWajaranKertasPeperiksaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wajaran_kertas_peperiksaan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peperiksaan');
            $table->unsignedBigInteger('id_tahun_peperiksaan');
            $table->unsignedBigInteger('id_mata_pelajaran');
            $table->unsignedBigInteger('id_kertas_peperiksaan');
            $table->unsignedBigInteger('id_jadual_peperiksaan')->nullable();
            $table->float('wajaran', 8,2);
            $table->timestamps();

            // Foreign key
            $table->foreign('id_peperiksaan')->references('id')->on('peperiksaan');
            $table->foreign('id_tahun_peperiksaan')->references('id')->on('peperiksaan__tahun_peperiksaan');
            $table->foreign('id_mata_pelajaran')->references('id')->on('ref_peperiksaan__kod_mata_pelajaran');
            $table->foreign('id_kertas_peperiksaan')->references('id')->on('ref_kertas_peperiksaan');
            $table->foreign('id_jadual_peperiksaan')->references('id')->on('peperiksaan__jadual_peperiksaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wajaran_kertas_peperiksaan');
    }
}
