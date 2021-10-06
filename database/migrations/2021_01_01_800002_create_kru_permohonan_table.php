<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKruPermohonanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kru__permohonan', function (Blueprint $table) {

            $table->id();
            $table->integer('id_kru');
            $table->integer('id_jawatan_permohonan')->unsigned();
            $table->integer('kod_mp_permohonan');
            $table->integer('kod_pentaksiran');
            $table->integer('tahun');
            $table->tinyInteger('status_surat_pelantikan')->default(1);
            $table->tinyInteger('status_sijil_penghargaan')->default(1);
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
        Schema::dropIfExists('kru__permohonan');
    }
}
