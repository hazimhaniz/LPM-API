<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKruPerkhidmatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kru__perkhidmatan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kru');
            $table->integer('id_user');
            $table->integer('id_pemeriksa');
            $table->string('jawatan')->nullable();
            $table->string('gred_jawatan')->nullable();
            $table->string('tetap_sandaran')->nullable();
            $table->string('tarikh_bersara')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kru__perkhidmatan');
    }
}
