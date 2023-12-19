<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyPairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('currency_pairs')) { return; }

        Schema::create('currency_pairs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('currency_1_id')->index();
            $table->unsignedBigInteger('currency_2_id')->index();
            $table->string('title', 50);
            $table->timestamps();

            $table->foreign('currency_1_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('currency_2_id')->references('id')->on('currencies')->onDelete('cascade');
        });

        DB::table('currency_pairs')->insert(
            array(
                ["id" => 1, "title" => "UAH/USD", "currency_1_id" => 125, "currency_2_id" => 127],
                ["id" => 2, "title" => "UAH/EUR", "currency_1_id" => 125, "currency_2_id" => 38],
                ["id" => 3, "title" => "UAH/PLN", "currency_1_id" => 125, "currency_2_id" => 99],
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
