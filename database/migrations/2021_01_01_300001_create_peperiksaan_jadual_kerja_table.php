<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeperiksaanJadualKerjaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peperiksaan__jadual_kerja', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tahun_peperiksaan');
            $table->string('keterangan');
            $table->dateTime('tarikh_mula');
            $table->dateTime('tarikh_tamat');
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
        Schema::dropIfExists('peperiksaan__jadual_kerja');
    }
}
