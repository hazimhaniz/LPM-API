<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefPeperiksaanKodJenisBayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_peperiksaan__kod_jenis_bayaran', function (Blueprint $table) {
            $table->id();
            $table->char('kod_jenis_bayaran');
            $table->integer('id_peperiksaan');
            $table->char('keterangan');
            $table->char('jumlah');
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
        Schema::dropIfExists('ref_peperiksaan__kod_jenis_bayaran');
    }
}
