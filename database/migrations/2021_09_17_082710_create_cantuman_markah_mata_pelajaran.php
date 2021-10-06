<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCantumanMarkahMataPelajaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cantuman_markah_mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_calon');
            $table->unsignedBigInteger('id_peperiksaan');
            $table->unsignedBigInteger('id_tahun_peperiksaan');
            $table->unsignedBigInteger('id_mata_pelajaran');
            $table->unsignedBigInteger('id_jadual_peperiksaan')->nullable();
            $table->unsignedBigInteger('id_gred')->nullable();
            $table->json('kertas_cantuman')->nullable();
            $table->float('markah_keseluruhan', 8, 2)->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Foreign key
            $table->foreign('id_peperiksaan')->references('id')->on('peperiksaan');
            $table->foreign('id_tahun_peperiksaan')->references('id')->on('peperiksaan__tahun_peperiksaan');
            $table->foreign('id_mata_pelajaran')->references('id')->on('ref_peperiksaan__kod_mata_pelajaran');
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
        Schema::dropIfExists('cantuman_markah_mata_pelajaran');
    }
}
