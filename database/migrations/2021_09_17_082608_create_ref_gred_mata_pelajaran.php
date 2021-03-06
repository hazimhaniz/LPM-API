<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefGredMataPelajaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_gred_mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_peperiksaan');
            $table->unsignedBigInteger('id_tahun_peperiksaan');
            $table->unsignedBigInteger('id_mata_pelajaran');
            $table->unsignedBigInteger('id_kertas_peperiksaan');
            $table->unsignedBigInteger('id_jadual_peperiksaan')->nullable();
            $table->string('nama');
            $table->string('penerangan')->nullable();
            $table->integer('markah_minima')->default(0);
            $table->integer('markah_maksima')->default(100);
            $table->softDeletes();
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
        Schema::dropIfExists('ref_gred_mata_pelajaran');
    }
}
