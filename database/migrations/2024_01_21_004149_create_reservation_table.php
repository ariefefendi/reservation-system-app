<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('tb_reservation', function (Blueprint $table) {
            $table->id('ID', 5);
            $table->foreignId('ID_MEMBER')->constrained()->references('ID_MEMBER')->on('tb_member');
            $table->foreignId('TABLENUMBER')->constrained()->references('TABLENUMBER')->on('tb_table_exis');

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
        Schema::dropIfExists('tb_reservation');
    }
}
