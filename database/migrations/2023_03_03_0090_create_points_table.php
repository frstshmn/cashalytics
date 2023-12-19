<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('pincode', 4)->default("0000");
            $table->string('location', 100)->nullable();
            $table->string('address', 100)->nullable();
            $table->boolean('is_open')->default(false);
            $table->boolean('disabled')->default(false);
            $table->unsignedBigInteger('group_id')->default(1)->index();
            $table->unsignedBigInteger('employee_id')->default(1)->index()->nullable()->constrained();
            $table->string('comments', 100)->nullable();
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
        });

        DB::table('points')->insert(
            array(
                [
                    "id" => 1,
                    "title" => "Тестова точка",
                    "pincode" => "0000",
                    "location" => "50.4501, 30.5234",
                    "address" => "вул. Тестова, 1",
                    "is_open" => false,
                    "disabled" => false,
                    "group_id" => 1,
                    "employee_id" => 1,
                    "comments" => "Пункт для тестування",
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
