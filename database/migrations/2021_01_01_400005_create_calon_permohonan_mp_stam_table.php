<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonPermohonanMpStamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon__permohonan_mp_stam', function (Blueprint $table) {
            $table->id();
            $table->integer('id_calon');
            $table->json('ids_mata_pelajaran')->nullable();
            $table->tinyInteger('id_status_pengesahan');
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
        Schema::dropIfExists('calon__permohonan_mp_stam');
    }
}
