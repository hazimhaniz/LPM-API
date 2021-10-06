<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonKesKhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon__kes_khas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_calon');
            $table->integer('id_jenis_kes_khas');
            $table->char('tindakan');
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
        Schema::dropIfExists('calon__kes_khas');
    }
}
