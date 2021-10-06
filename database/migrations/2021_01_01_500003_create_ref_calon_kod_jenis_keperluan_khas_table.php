<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefCalonKodJenisKeperluanKhasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_calon__kod_jenis_keperluan_khas', function (Blueprint $table) {
            $table->id();
            $table->char('kod_jenis_keperluan_khas');
            $table->char('keterangan');
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
        Schema::dropIfExists('ref_calon__kod_jenis_keperluan_khas');
    }
}
