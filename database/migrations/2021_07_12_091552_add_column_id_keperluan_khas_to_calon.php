<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnIdKeperluanKhasToCalon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon', function (Blueprint $table) {
            $table->integer('id_keperluan_khas')->nullable();
            $table->string('no_kad_oku')->nullable();
            $table->string('angka_giliran_terakhir')->nullable();
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
            $table->dropColumn('id_keperluan_khas');
            $table->dropColumn('no_kad_oku');
            $table->dropColumn('angka_giliran_terakhir');
        });
    }
}
