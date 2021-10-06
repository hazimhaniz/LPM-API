<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToRefPeperiksaanKodSekolah extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_peperiksaan__kod_sekolah', function (Blueprint $table) {
            $table->integer('id_parlimen')->nullable();
            $table->integer('id_dun')->nullable();
            $table->integer('id_lokasi')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ref_peperiksaan__kod_sekolah', function (Blueprint $table) {
            $table->dropColumn('id_parlimen');
            $table->dropColumn('id_dun');
            $table->dropColumn('id_lokasi');
        });
    }
}
