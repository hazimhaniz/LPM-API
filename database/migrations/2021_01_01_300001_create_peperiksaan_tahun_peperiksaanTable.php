<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeperiksaanTahunPeperiksaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peperiksaan__tahun_peperiksaan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_peperiksaan');
            $table->integer('id_sesi_pengambilan')->nullable();
            $table->integer('tahun');
            $table->tinyInteger('id_status_tahun');
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
        Schema::dropIfExists('peperiksaan__tahun_peperiksaan');
    }
}
