<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeToCalonPembetulanMaklumat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon__pembetulan_maklumat', function (Blueprint $table) {
            $table->string('maklumat_asal')->change();
            $table->string('maklumat_baharu')->change();
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
            $table->dropColumn('maklumat_asal');
            $table->dropColumn('maklumat_baharu');
        });
    }
}
