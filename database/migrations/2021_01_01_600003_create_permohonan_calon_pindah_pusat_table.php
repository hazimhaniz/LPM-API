<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanCalonPindahPusatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan__calon_pindah_pusat', function (Blueprint $table) {
            $table->id();
            $table->integer('id_peperiksaan');
            $table->integer('id_tahun_peperiksaan');
            $table->integer('id_calon')->nullable();
            $table->integer('id_pusat')->nullable();
            $table->integer('id_pusat_baharu')->default(0);
            $table->integer('id_status_pindah')->default(0);
            $table->integer('id_status_pengesahan')->default(0);
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
        Schema::dropIfExists('permohonan__calon_pindah_pusat');
    }
}
