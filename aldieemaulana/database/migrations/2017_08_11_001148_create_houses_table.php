<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function(Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('id_block');
            $table->smallInteger('number');
            $table->enum('status', ['kosong', 'akad', 'isi']);
            $table->boolean('indicator_satu');
            $table->boolean('indicator_dua');
            $table->boolean('indicator_tiga');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('houses');
    }
}
