<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTypeAlamatToKruAlamat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kru__alamat', function (Blueprint $table) {
            $table->char('alamat_1', 150)->nullable()->change();
            $table->string('alamat');
            $table->dropColumn('alamat_2');
            $table->dropColumn('alamat_3');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kru__alamat', function (Blueprint $table) {
            $table->dropColumn('alamat');
            $table->char('alamat_2', 150);
            $table->char('alamat_3', 150);
        });
    }
}
