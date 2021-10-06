<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanPusatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan__pusat', function (Blueprint $table) {
            $table->id();
            $table->integer('id_sekolah');
            $table->integer('id_tahun_peperiksaan');
            $table->integer('id_peperiksaan');

            $table->integer('id_pusat')->nullable();
            $table->text('alasan')->nullable();
            $table->char('bekalan_elektrik')->nullable();
            $table->char('bekalan_air')->nullable();
            $table->char('telefon')->nullable();
            $table->char('tandas')->nullable();
            $table->char('bangku_calon')->nullable();
            $table->char('meja_calon')->nullable();
            $table->integer('id_negeri')->nullable();

            $table->tinyInteger('id_status_pengesahan');

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
        Schema::dropIfExists('permohonan__pusat');
    }
}
