<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->increments('id');
            $table->double('commission_1');
            $table->double('commission_2');
            $table->double('commission_3');
            $table->double('commission_4');
            $table->double('commission_5');
            $table->double('commission_6');
            $table->double('commission_7');
            $table->double('commission_8');
            $table->double('commission_9');
            $table->double('commission_10');     
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
        Schema::dropIfExists('commissions');
    }
}
