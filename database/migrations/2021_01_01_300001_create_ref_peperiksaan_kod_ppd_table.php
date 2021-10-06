<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefPeperiksaanKodPpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_peperiksaan__kod_ppd', function (Blueprint $table) {
            $table->id();
            $table->char('kod_ppd');
            $table->string('nama_ppd');
            $table->integer('id_negeri');
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
        Schema::dropIfExists('ref_peperiksaan__kod_ppd');
    }
}
