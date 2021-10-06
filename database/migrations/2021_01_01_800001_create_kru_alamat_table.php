<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKruAlamatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kru__alamat', function (Blueprint $table) {

            $table->id();
            $table->integer('id_kru');
            $table->integer('jenis_alamat');
            $table->char('alamat_1', 150);
            $table->char('alamat_2', 150);
            $table->char('alamat_3', 150);
            $table->char('poskod', 6);
            $table->integer('id_bandar');
            $table->integer('id_negeri');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kru__alamat');
    }
}
