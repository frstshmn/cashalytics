<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->string('username')->unique();
            $table->string('phone', 13)->unique();
            $table->string('password');
            $table->boolean('is_online');
            $table->dateTime('last_login');
            $table->dateTime('last_logout');
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('responsible_id');
            $table->string('comments');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('user_types')->onDelete('cascade');
            $table->foreign('responsible_id')->references('id')->on('users')->onDelete('cascade');
        });

        DB::table('users')->insert(
            array(
                [
                    "id" => 1,
                    "first_name" => "Start",
                    "last_name" => "Admin",
                    "email" => "example75@mail.com",
                    "username" => "admin",
                    "phone" => "+380001234567",
                    "password" => '$2y$10$mUGtCcxpOP/Vd2zxXoprIeKd9CxUP8LrWzY2QlwC13IWXtkg/zY7O',
                    "is_online" => false,
                    "last_login" => "2021-01-01 00:00:00",
                    "last_logout" => "2021-01-01 00:00:00",
                    "group_id" => 1,
                    "type_id" => 1,
                    "responsible_id" => 1,
                    "comments" => "Admin",
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
