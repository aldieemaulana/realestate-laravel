<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });


        DB::table('roles')->insert([
                'name' => 'manager'
            ]
        );

        DB::table('roles')->insert([
                'name' => 'supervisor'
            ]
        );

        DB::table('roles')->insert([
                'name' => 'marketing'
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
        Schema::drop('roles');
    }
}
