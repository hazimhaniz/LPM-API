<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKodPpdToRefConstantParlimenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_constant__parlimen', function (Blueprint $table) {
            $table->foreignId('id_kod_ppd')->nullable();

            $table->foreign('id_kod_ppd')->references('id')->on('ref_peperiksaan__kod_ppd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ref_constant__parlimen', function (Blueprint $table) {
            $table->dropForeign('ref_constant__parlimen_id_kod_ppd_foreign');
            $table->dropColumn('id_kod_ppd');
        });
    }
}
