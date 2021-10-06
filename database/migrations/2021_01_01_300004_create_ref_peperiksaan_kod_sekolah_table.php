<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefPeperiksaanKodSekolahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_peperiksaan__kod_sekolah', function (Blueprint $table) {

            $table->id();
            $table->char('kod_sekolah');
            $table->char('nama_sekolah');
            $table->char('nama_pengetua');
            $table->text('alamat_sekolah');
            $table->char('emel_sekolah');
            $table->char('no_telefon');
            $table->char('no_faks');
            $table->char('poskod');

            $table->integer('id_jenis_sekolah');

            $table->integer('id_ppd');
            $table->integer('id_bandar');
            $table->integer('id_daerah');
            $table->integer('id_negeri');

            $table->boolean('status', 1)->default(1);

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
        Schema::dropIfExists('ref_peperiksaan__kod_sekolah');
    }
}
