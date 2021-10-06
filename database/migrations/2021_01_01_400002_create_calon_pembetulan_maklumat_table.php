<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonPembetulanMaklumatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon__pembetulan_maklumat', function (Blueprint $table) {
            $table->id();
            $table->integer('id_calon');
            $table->integer('id_jenis_pembetulan');
            $table->char('maklumat_asal', 150);
            $table->char('maklumat_baharu', 150);
            $table->char('no_resit', 25);
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
        Schema::dropIfExists('calon__pembetulan_maklumat');
    }
}
