<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_pass_member', function (Blueprint $table) {
            $table->id('ID_PASS_MEMBER', 5);
            $table->string('PASS');
            $table->foreignId('ID_MEMBER')->constrained()->references('ID_MEMBER')->on('tb_member');
            $table->boolean('TRY_COUNT')->default(0);
            $table->boolean('ISLOGIN')->default(0);
            $table->boolean('MAC_ADDRESS')->default(0);
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
        Schema::dropIfExists('tb_pass_member');
    }
}
