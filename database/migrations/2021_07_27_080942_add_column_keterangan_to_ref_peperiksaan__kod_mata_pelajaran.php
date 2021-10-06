<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKeteranganToRefPeperiksaanKodMataPelajaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_peperiksaan__kod_mata_pelajaran', function (Blueprint $table) {
            $table->string('keterangan')->after('id_peperiksaan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ref_peperiksaan__kod_mata_pelajaran', function (Blueprint $table) {
            $table->dropColumn('keterangan');
        });
    }
}
