<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon', function (Blueprint $table) {
            $table->id();
            $table->integer('id_peperiksaan');
            $table->integer('id_tahun_peperiksaan');
            $table->char('no_kad_pengenalan', 12);
            $table->char('no_pengenalan_lain', 20)->nullable();
            $table->string('nama');
            $table->string('nama_i18n')->nullable();
            $table->char('no_telefon', 15)->nullable();
            $table->char('emel', 100)->nullable();
            $table->date('tarikh_lahir')->nullable();
            $table->integer('id_pusat')->nullable();
            $table->integer('id_user')->nullable();
            $table->integer('id_jantina');
            $table->integer('id_keturunan');
            $table->integer('id_agama');
            $table->integer('id_warganegara');
            $table->integer('id_peperiksaan_terakhir')->nullable();
            $table->integer('id_jenis_pendaftaran');
            $table->integer('tahun_peperiksaan_terakhir')->nullable();
            $table->char('angka_giliran')->nullable();
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
        Schema::dropIfExists('calon');
    }
}
