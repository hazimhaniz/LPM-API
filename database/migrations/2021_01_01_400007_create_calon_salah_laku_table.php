<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonSalahLakuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon__salah_laku', function (Blueprint $table) {
            $table->id();
            $table->integer('id_calon');
            $table->integer('id_mata_pelajaran');
            $table->integer('tahun');
            $table->dateTime('tarikh_peperiksaan');
            $table->integer('id_jenis_salah_laku');
            $table->tinyInteger('status_salah_laku_awal');
            $table->dateTime('tarikh_keputusan_awal');
            $table->char('catatan_awal');
            $table->tinyInteger('status_salah_laku_terkini');
            $table->dateTime('tarikh_keputusan_terkini');
            $table->char('catatan_terkini');
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
        Schema::dropIfExists('calon__salah_laku');
    }
}