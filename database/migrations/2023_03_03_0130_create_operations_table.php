<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('operations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('outcome_currency_id')->index()->nullable()->constrained();
            $table->unsignedBigInteger('income_currency_id')->index()->nullable()->constrained();
            $table->double('outcome_amount')->default(0)->nullable();
            $table->double('income_amount')->default(0)->nullable();
            $table->double('rate')->default(0);
            $table->unsignedBigInteger('point_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('client_id')->index()->nullable()->constrained();
            $table->string('comments')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();

            $table->foreign('outcome_currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('income_currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->foreign('point_id')->references('id')->on('points')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
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
