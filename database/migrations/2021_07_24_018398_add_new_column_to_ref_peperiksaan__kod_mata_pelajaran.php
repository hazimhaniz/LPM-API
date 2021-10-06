<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnToRefPeperiksaanKodMataPelajaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_peperiksaan__kod_mata_pelajaran', function (Blueprint $table) {
            $table->string('kod_mata_pelajaran');
            $table->string('nama_mata_pelajaran');
            $table->string('nama_mata_pelajaran_opt')->nullable();
            $table->integer('calon_yang_dibenarkan')->nullable();
            $table->integer('jenis_calon')->nullable();
            $table->string('markah_maksimum')->nullable();
            $table->string('cara_penentuan_gred')->nullable();
            $table->integer('jenis_bayaran')->nullable();
            $table->integer('format_pentaksiran')->nullable();
            $table->integer('pentaksiran_opt')->nullable();
            $table->integer('kerja_kursus')->nullable();
            $table->boolean('mata_pelajaran_opt')->nullable();
            $table->string('catatan')->nullable();
            $table->boolean('status')->default(false);
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
            $table->dropColumn('kod_mata_pelajaran');
            $table->dropColumn('nama_mata_pelajaran');
            $table->dropColumn('nama_mata_pelajaran_opt');
            $table->dropColumn('calon_yang_dibenarkan');
            $table->dropColumn('jenis_calon');
            $table->dropColumn('markah_maksimum');
            $table->dropColumn('cara_penentuan_gred');
            $table->dropColumn('jenis_bayaran');
            $table->dropColumn('format_pentaksiran');
            $table->dropColumn('pentaksiran_opt');
            $table->dropColumn('kerja_kursus');
            $table->dropColumn('mata_pelajaran_opt');
            $table->dropColumn('catatan');
            $table->dropColumn('status');
        });
    }
}
