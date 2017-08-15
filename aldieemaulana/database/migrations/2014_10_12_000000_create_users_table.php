<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('phone', 15)->nullable();
            $table->string('role', 20);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
                'name' => 'Manager',
                'email' => 'manager@aldieemaulana.dev',
                'username' => 'manager',
                'password' => bcrypt('manager'),
                'phone' => '087770122245',
                'role' => 1
            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
