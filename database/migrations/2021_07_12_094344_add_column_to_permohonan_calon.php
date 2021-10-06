<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToPermohonanCalon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permohonan__calon', function (Blueprint $table) {
            $table->string('tahun_peperiksaan_spm');
            $table->string('angka_giliran_spm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permohonan__calon', function (Blueprint $table) {
            $table->dropColumn('tahun_peperiksaan_spm');
            $table->dropColumn('angka_giliran_spm');
        });
    }
}
