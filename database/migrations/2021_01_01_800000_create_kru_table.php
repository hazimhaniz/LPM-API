<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kru', function (Blueprint $table) {

            $table->id();
            $table->integer('id_user');
            $table->integer('id_peperiksaan')->nullable();
            $table->char('id_pengguna')->nullable();
            $table->char('no_kad_pengenalan');
            $table->char('no_pengenalan_lain', 20)->nullable();
            $table->char('nama');
            $table->char('nama_i18n');
            $table->char('no_telefon_bimbit', 15);
            $table->char('no_telefon_rumah', 15)->nullable();
            $table->char('emel');
            $table->dateTime('tarikh_lahir');
            $table->integer('id_jantina');
            $table->integer('id_keturunan');
            $table->integer('id_agama');
            $table->integer('id_sekolah')->nullable();
            $table->char('jawatan_perkhidmatan');
            $table->char('gred_jawatan');
            $table->integer('id_jenis_perkhidmatan');
            $table->dateTime('tarikh_bersara');
            $table->char('no_cukai_pendapatan');
            $table->char('no_gaji');
            $table->double('gaji_pokok');
            $table->boolean('aktif')->default(false);

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
        Schema::dropIfExists('kru');
    }
}
