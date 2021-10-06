<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenKruPermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen__kru__permohonan_tuntutan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_permohonan_tuntutan');
            $table->integer('id_jenis_dokumen');
            $table->binary('dokumen');
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
        Schema::dropIfExists('dokumen__kru__permohonan_tuntutan');
    }
}
