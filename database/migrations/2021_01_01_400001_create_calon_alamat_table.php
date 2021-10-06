<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonAlamatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calon__alamat', function (Blueprint $table) {
            $table->id();
            $table->integer('id_calon');
            $table->integer('id_jenis_alamat');
            $table->char('alamat');
            $table->char('poskod');
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
        Schema::dropIfExists('calon__alamat');
    }
}
