<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointCash extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_cash', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('point_id')->index();
            $table->unsignedBigInteger('currency_id')->index();
            $table->double('amount')->default(0);
            $table->timestamps();

            $table->foreign('point_id')->references('id')->on('points')->onDelete('cascade');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
        });

        DB::table('point_cash')->insert(
            array(
                [
                    "id" => 1,
                    "point_id" => 1,
                    "currency_id" => 125,
                    "amount" => 0,
                ],
                [
                    "id" => 2,
                    "point_id" => 1,
                    "currency_id" => 127,
                    "amount" => 0,
                ],
                [
                    "id" => 3,
                    "point_id" => 1,
                    "currency_id" => 38,
                    "amount" => 0,
                ],
                [
                    "id" => 4,
                    "point_id" => 1,
                    "currency_id" => 99,
                    "amount" => 0,
                ],
                [
                    "id" => 5,
                    "point_id" => 1,
                    "currency_id" => 31,
                    "amount" => 0,
                ],
                [
                    "id" => 6,
                    "point_id" => 1,
                    "currency_id" => 41,
                    "amount" => 0,
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
