<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('comment', 100)->nullable();
            $table->timestamps();
        });

        DB::table('groups')->insert(
            array(
                [
                    "id" => 1,
                    "title" => "Глобальна",
                    "comment" => "Глобальна група адміністраторів",
                ]
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
    }
}
