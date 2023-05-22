<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('comments')->nullable();
        });

        DB::table('user_types')->insert(
            array(
                ["id" => 1, "title" => "Менеджер", "comments" => "Керує касирами, встановлює курси та аналізує роботу пунктів"],
                ["id" => 2, "title" => "Касир", "comments" => "Здійснює безпосередні операції обміну валют та керування"]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_types');
    }
}
