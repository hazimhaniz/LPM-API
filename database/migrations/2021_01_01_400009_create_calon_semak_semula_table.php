<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonSemakSemulaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon__semak_semula', function (Blueprint $table) {
            $table->id();
            $table->integer('id_skor_calon');
            $table->integer('id_mata_pelajaran');
            $table->integer('markah_baharu');
            $table->char('gred_baharu');
            $table->char('no_resit');
            $table->dateTime('tarikh_resit');
            $table->integer('id_penjenisan_bayaran');
            $table->tinyInteger('status_permohonan');
            $table->tinyInteger('status_pembayaran');
            $table->tinyInteger('status_keputusan_semak');
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
        Schema::dropIfExists('calon__semak_semula');
    }
}