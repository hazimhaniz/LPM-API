<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToCalonPembetulanMaklumat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon__pembetulan_maklumat', function (Blueprint $table) {
            $table->integer('id_jenis_pendaftaran');
            $table->integer('id_peperiksaan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calon__pembetulan_maklumat', function (Blueprint $table) {
            $table->dropColumn('id_jenis_pendaftaran');
            $table->dropColumn('id_peperiksaan');
        });
    }
}
