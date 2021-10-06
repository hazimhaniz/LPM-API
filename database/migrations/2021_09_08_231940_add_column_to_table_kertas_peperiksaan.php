<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToTableKertasPeperiksaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ref_kertas_peperiksaan', function (Blueprint $table) {
            $table->tinyInteger('id_peperiksaan')->after('id');
            $table->string('jenis_kertas');
            $table->boolean('pilihan');
            $table->boolean('kertas_hurdle');
            $table->boolean('kertas_matriks');
            $table->boolean('dikira_gred');
            $table->string('bahasa');
            $table->boolean('jenis_semakan');
            $table->boolean('mensyuarat_pemeriksa');
            $table->boolean('penentuan_standard');
            $table->boolean('lpm');
            $table->json('masa_peperiksaan_kertas')->nullable()->change();
            $table->boolean('status_kertas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ref_kertas_peperiksaan', function (Blueprint $table) {
            $table->dropColumn('id_peperiksaan');
            $table->dropColumn('jenis_kertas');
            $table->dropColumn('pilihan');
            $table->dropColumn('kertas_hurdle');
            $table->dropColumn('kertas_matriks');
            $table->dropColumn('dikira_gred');
            $table->dropColumn('bahasa');
            $table->dropColumn('jenis_semakan');
            $table->dropColumn('mensyuarat_pemeriksa');
            $table->dropColumn('penentuan_standard');
            $table->dropColumn('lpm');
            $table->json('masa_peperiksaan_kertas')->change();
            $table->dropColumn('status_kertas');
        });
    }
}
