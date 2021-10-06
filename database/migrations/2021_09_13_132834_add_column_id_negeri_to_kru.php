<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdNegeriToKru extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kru', function (Blueprint $table) {
            $table->tinyInteger('id_negeri')->nullable()->after('id_sekolah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kru', function (Blueprint $table) {
            $table->dropColumn('id_negeri');
        });
    }
}
