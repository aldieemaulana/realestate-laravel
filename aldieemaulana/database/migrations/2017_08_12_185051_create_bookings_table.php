<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function(Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('id_house')->nullable();
            $table->string('nama')->default('Pembeli');
            $table->enum('status', ['belum_nikah', 'nikah', 'cerai'])->default('belum_nikah');
            $table->string('telepon')->default('0');
            $table->date('tanggal_wawancara')->nullable();
            $table->bigInteger('booking_fee')->default('0');
            $table->date('tanggal_booking_fee')->nullable();
            $table->bigInteger('dp_1')->default('0');
            $table->date('tanggal_dp_1')->nullable();
            $table->bigInteger('dp_2')->default('0');
            $table->date('tanggal_dp_2')->nullable();
            $table->bigInteger('dp_3')->default('0');
            $table->date('tanggal_dp_3')->nullable();
            $table->bigInteger('dp_4')->default('0');
            $table->date('tanggal_dp_4')->nullable();
            $table->bigInteger('dp_5')->default('0');
            $table->date('tanggal_dp_5')->nullable();
            $table->bigInteger('kpr_diajukan')->default('0');
            $table->bigInteger('kpr_disetujui')->default('0');
            $table->bigInteger('kpr_selisih')->default('0');
            $table->boolean('bayar')->default('0');
            $table->enum('metode_bayar', ['cash', 'credit'])->default('credit');
            $table->date('tanggal_akad')->nullable();
            $table->date('tanggal_cair')->nullable();
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
        Schema::drop('bookings');
    }
}
