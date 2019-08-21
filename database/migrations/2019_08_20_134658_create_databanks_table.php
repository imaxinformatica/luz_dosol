<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatabanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('databanks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('bank_code');
            $table->integer('agency');
            $table->integer('account');
            $table->integer('account_type');
            $table->string('cpf_holder');
            $table->string('name_holder');
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
        Schema::dropIfExists('databanks');
    }
}
