<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefCalonKodKemasukanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_calon__kod_kemasukan', function (Blueprint $table) {
            $table->id();
            $table->char('kod_kemasukan');
            $table->integer('id_peperiksaan');
            $table->char('keterangan');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('ref_calon__kod_kemasukan');
    }
}
