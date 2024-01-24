<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportReservationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_reservation', function (Blueprint $table) {
            // $table->id()->unique();
            $table->foreignId('ID_MEMBER')->constrained()->references('ID_MEMBER')->on('tb_member');
            $table->foreignId('TABLENUMBER')->constrained()->references('TABLENUMBER')->on('tb_table_exis');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report_reservation');
    }
}
