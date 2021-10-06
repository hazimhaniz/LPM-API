<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKruBorangJawapanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kru__borang_jawapan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_kru');
            $table->integer('id_pemeriksa');
            $table->integer('kod_kertas');
            $table->string('kod_sek')->nullable();
            $table->string('alamat_sek_1')->nullable();
            $table->string('alamat_sek_2')->nullable();
            $table->string('alamat_sek_3')->nullable();
            $table->string('poskod')->nullable();
            $table->string('no_faks_sek')->nullable();
            $table->char('no_tel_sek', 60)->nullable();
            $table->string('alamat_rmh_1')->nullable();
            $table->string('alamat_rmh_2')->nullable();
            $table->string('alamat_rmh_3')->nullable();
            $table->char('ic_no');
            $table->char('no_tel', 60)->nullable();
            $table->string('kelulusan_akademik')->nullable();
            $table->string('gred_jawatan')->nullable();
            $table->char('pengalaman_memeriksa')->nullable();
            $table->char('pengalaman_memeriksa_hingga')->nullable();
            $table->json('subject_ngajar')->nullable();
            $table->tinyInteger('subject_lain')->default(1);
            $table->string('mata_pelajaran')->nullable();
            $table->string('tahun_ngajar')->nullable();
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
        Schema::dropIfExists('kru__borang_jawapan');
    }
}
