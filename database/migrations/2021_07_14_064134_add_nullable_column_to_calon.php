<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Doctrine\DBAL\Types\StringType;
use Doctrine\DBAL\Types\Type;

class AddNullableColumnToCalon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        if (!Type::hasType('char')) {
            Type::addType('char', StringType::class);
        }
        Schema::table('calon', function (Blueprint $table) {
            $table->char('no_kad_pengenalan',12)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('calon', function (Blueprint $table) {
            $table->char('no_kad_pengenalan')->change();
        });
    }
}
