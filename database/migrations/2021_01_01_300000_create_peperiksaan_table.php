<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeperiksaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peperiksaan', function (Blueprint $table) {
            $table->id();
            $table->char('kod_peperiksaan');
            $table->char('keterangan');
            $table->char('keterangan_panjang');
            $table->integer('id_tahun_peperiksaan_semasa')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('peperiksaan');
    }
}
