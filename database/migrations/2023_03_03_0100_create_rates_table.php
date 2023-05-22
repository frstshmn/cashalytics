<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pair_id')->default(1)->index();
            $table->unsignedBigInteger('point_id')->default(1)->index();
            $table->double('sell_price')->default(0);
            $table->double('buy_price')->default(0);
            $table->timestamps();

            $table->unique(['pair_id','point_id']);

            $table->foreign('pair_id')->references('id')->on('currency_pairs')->onDelete('cascade');
            $table->foreign('point_id')->references('id')->on('points')->onDelete('cascade');
        });

        DB::table('rates')->insert(
            array(
                [
                    "id" => 1,
                    "pair_id" => 1,
                    "point_id" => 1,
                    "buy_price" => 38.80,
                    "sell_price" => 39.10,
                ],
                [
                    "id" => 2,
                    "pair_id" => 2,
                    "point_id" => 1,
                    "buy_price" => 40.80,
                    "sell_price" => 41.20,
                ],
                [
                    "id" => 3,
                    "pair_id" => 3,
                    "point_id" => 1,
                    "buy_price" => 8.75,
                    "sell_price" => 8.90,
                ],
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
        Schema::dropIfExists('rates');
    }
}
