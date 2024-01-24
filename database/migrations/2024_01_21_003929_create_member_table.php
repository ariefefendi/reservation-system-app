<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    public function up()
    {
        Schema::create('tb_member', function (Blueprint $table) {
            $table->id('ID_MEMBER', 3);
            $table->string('NAME', 50);
            $table->string('EMAIL', 50)->unique();
            $table->string('USERNAME', 50);
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
        Schema::dropIfExists('tb_member');
    }
}
