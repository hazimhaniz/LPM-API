<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKruEmailContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kru__email_content', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_kru');
            $table->integer('id_pemeriksa');
            $table->string('tajuk_emel')->nullable();
            $table->longText('kandungan_emel')->nullable();
            $table->longText('tambahan_kandungan_emel')->nullable();
            $table->char('kod_status', 60)->nullable();
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
        Schema::dropIfExists('kru__email_content');
    }
}
