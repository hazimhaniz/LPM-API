<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBayaranColumnToCalonPembetulanMaklumat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('calon__pembetulan_maklumat', function (Blueprint $table) {
            $table->text('url_bayaran')->nullable();
            $table->text('url_status')->nullable();
            $table->tinyInteger('id_status_permohonan')->nullable();
            $table->char('jumlah_bayaran');
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
            $table->dropColumn('url_bayaran');
            $table->dropColumn('url_status');
            $table->dropColumn('id_status_permohonan');
            $table->dropColumn('jumlah_bayaran');
        });
    }
}
