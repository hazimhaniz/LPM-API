<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefPeperiksaanKodPusatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_peperiksaan__kod_pusat', function (Blueprint $table) {
            $table->id();
            $table->integer('no_sekolah');
            $table->char('kod_pusat');
            $table->integer('id_jenis_calon');
            $table->string('nama_pusat')->nullable();
            $table->string('nama_pusat_i18n')->nullable();
            $table->integer('jumlah_calon');
            $table->integer('id_sekolah');
            $table->integer('id_tahun_peperiksaan');
            $table->integer('id_bilik_kebal')->nullable();
            $table->json('ids_mata_pelajaran')->nullable();
            $table->tinyInteger('id_status_pendaftaran')->default(2);
            $table->tinyInteger('id_status_pendaftaran_calon')->default(3);
            $table->tinyInteger('id_status_janaan_angka_giliran')->default(2);
            $table->tinyInteger('id_status_tempoh_pendaftaran')->default(1);
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
        Schema::dropIfExists('ref_peperiksaan__kod_pusat');
    }
}
