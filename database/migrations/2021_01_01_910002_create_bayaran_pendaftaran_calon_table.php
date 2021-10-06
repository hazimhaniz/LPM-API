<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBayaranPendaftaranCalonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bayaran__pendaftaran_calon', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tahun_peperiksaan');
            $table->integer('id_user');
            $table->integer('id_pusat')->nullable();
            $table->integer('id_calon')->nullable();
            $table->text('url_bayaran')->nullable();
            $table->text('url_status')->nullable();
            $table->char('jumlah_bayaran');
            $table->char('no_resit');
            $table->datetime('tarikh_resit');
            $table->tinyInteger('id_penjenisan_bayaran')->nullable();
            $table->tinyInteger('id_status_permohonan')->nullable();
            $table->tinyInteger('id_status_pembayaran')->nullable();
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
        Schema::dropIfExists('bayaran__pendaftaran_calon');
    }
}
