l<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonPembatalanPendaftaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon__pembatalan_pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->integer('id_calon');
            $table->char('alasan_pembatalan');
            $table->char('nama_ibubapa', 100);
            $table->char('no_kad_pengenalan_ibubapa', 20);
            $table->char('catatan')->nullable();
            $table->integer('id_status_pengesahan');
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
        Schema::dropIfExists('calon__pembatalan_pendaftaran');
    }
}
