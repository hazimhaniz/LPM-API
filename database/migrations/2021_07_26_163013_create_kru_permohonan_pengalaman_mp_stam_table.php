<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKruPermohonanPengalamanMpStamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kru__permohonan_pengalaman_mp_stam', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kru');
            $table->integer('id_user');
            $table->integer('id_pemeriksa');
            $table->integer('id_matapelajaran');
            $table->string('darjah_tingkatan')->nullable();
            $table->string('tahun_mula')->nullable();
            $table->string('tahun_tamat')->nullable();
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
        Schema::dropIfExists('kru__permohonan_pengalaman_mp_stam');
    }
}
