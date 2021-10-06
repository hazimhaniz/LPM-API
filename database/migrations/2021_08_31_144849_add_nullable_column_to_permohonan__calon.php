<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableColumnToPermohonanCalon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('permohonan__calon', function (Blueprint $table) {
            $table->string('tahun_peperiksaan_spm')->nullable()->change();
            $table->string('angka_giliran_spm')->nullable()->change();
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
            $table->string('tahun_peperiksaan_spm')->change();
            $table->string('angka_giliran_spm')->change();
        });
    }
}
