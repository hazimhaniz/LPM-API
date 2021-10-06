<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefConstantDunTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ref_constant__dun', function (Blueprint $table) {
            $table->id();
            $table->char('kod_dun');
            $table->string('keterangan');
            $table->char('kod_parlimen');
            $table->integer('id_negeri');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('ref_constant__dun');
    }
}
