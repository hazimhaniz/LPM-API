<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnRefPeperiksaanKodMataPelajaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_peperiksaan__kod_mata_pelajaran', function (Blueprint $table) {
            $table->dropColumn('kod_mata_pelajaran');
            $table->dropColumn('keterangan');
            $table->dropColumn('status');
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
            $table->char('kod_mata_pelajaran');
            $table->char('keterangan');
            $table->tinyInteger('status')->default(1);
        });
    }
}
