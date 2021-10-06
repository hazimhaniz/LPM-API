<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonPendaftaranLewatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon__pendaftaran_lewat', function (Blueprint $table) {
            $table->id();
            $table->integer('id_calon');
            $table->char('no_resit');
            $table->dateTime('tarikh_resit');
            $table->integer('id_penjenisan_bayaran');
            $table->char('catatan')->nullable();
            $table->integer('status_pembayaran');
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
        Schema::dropIfExists('calon__pendaftaran_lewat');
    }
}
