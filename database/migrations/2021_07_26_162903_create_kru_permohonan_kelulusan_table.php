<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKruPermohonanKelulusanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kru__permohonan_kelulusan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kru');
            $table->integer('id_user');
            $table->integer('id_pemeriksa');
            $table->string('kelulusan_akademik_tertinggi')->nullable();
            $table->string('grade_akademik_tertinggi')->nullable();
            $table->string('tahun_akademik_tertinggi')->nullable();
            $table->string('kelulusan_ikhtisas')->nullable();
            $table->string('grade_ikhtisas')->nullable();
            $table->string('tahun_ikhtisas')->nullable();
            $table->string('kelulusan_mp_utama')->nullable();
            $table->string('grade_mp_utama')->nullable();
            $table->string('tahun_mp_utama')->nullable();
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
        Schema::dropIfExists('kru__permohonan_kelulusan');
    }
}
