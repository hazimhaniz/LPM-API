<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnNegaraToCalon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon', function (Blueprint $table) {
            $table->integer('id_negara')->after('id_warganegara')->default('1');
            $table->boolean('is_late')->after('id_jenis_pendaftaran')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calon', function (Blueprint $table) {
            $table->dropColumn('id_negara');
            $table->dropColumn('is_late');
        });
    }
}
