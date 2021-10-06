<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefPeperiksaanKodMataPelajaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_peperiksaan__kod_mata_pelajaran', function (Blueprint $table) {
            $table->id();
            $table->integer('id_peperiksaan');
            $table->char('kod_mata_pelajaran');
            $table->char('keterangan');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('ref_peperiksaan__kod_mata_pelajaran');
    }
}
