<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenCalonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen__calon', function (Blueprint $table) {
            $table->id();
            $table->integer('id_calon');
            $table->integer('id_jenis_dokumen');
            $table->binary('dokumen');
            $table->char('keterangan');
            $table->integer('size');
            $table->tinyInteger('id_status_pengesahan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dokumen__calon');
    }
}
