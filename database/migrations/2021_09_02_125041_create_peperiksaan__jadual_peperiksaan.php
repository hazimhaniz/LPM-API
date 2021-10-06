<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeperiksaanJadualPeperiksaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peperiksaan__jadual_peperiksaan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_mata_pelajaran');
            $table->integer('id_tahun_peperiksaan');
            $table->string('keterangan');
            $table->datetime('waktu_mula');
            $table->datetime('waktu_tamat');
            $table->integer('durasi');
            $table->boolean('status');
            $table->softDeletes();
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
        Schema::dropIfExists('peperiksaan__jadual_peperiksaan');
    }
}
