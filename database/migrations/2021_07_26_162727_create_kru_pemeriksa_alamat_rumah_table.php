<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKruPemeriksaAlamatRumahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kru__pemeriksa_alamat_rumah', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kru');
            $table->integer('id_user');
            $table->integer('id_pemeriksa');
            $table->string('alamat_1')->nullable();
            $table->string('alamat_2')->nullable();
            $table->string('alamat_3')->nullable();
            $table->char('poskod', 6);
            $table->integer('id_bandar');
            $table->integer('id_negeri');
            $table->char('no_telefon_rumah', 60);
            $table->char('no_telefon_bimbit', 60)->nullable();
            $table->string('no_emel');
            $table->char('no_cukai_pendapatan', 150)->nullable();
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
        Schema::dropIfExists('kru__pemeriksa_alamat_rumah');
    }
}
