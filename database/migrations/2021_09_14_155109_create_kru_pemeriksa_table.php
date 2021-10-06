<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKruPemeriksaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kru__pemeriksa', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kru');
            $table->integer('id_user');
            $table->integer('tahun');
            $table->tinyInteger('status_permohonan_pertama')->default(1);
            $table->tinyInteger('status_pelawaan')->default(1);
            $table->string('sebab_penolakan')->nullable();
            $table->tinyInteger('status_pemeriksa_lain')->default(1);
            $table->integer('id_malatapelajaran_lain')->nullable();
            $table->integer('tahun_memeriksa')->nullable();
            $table->tinyInteger('status_kelulusan')->default(1);
            $table->tinyInteger('status_kelulusan_janaan')->default(1);
            $table->tinyInteger('status_janaan')->default(1);
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
        Schema::dropIfExists('kru__pemeriksa');
    }
}
