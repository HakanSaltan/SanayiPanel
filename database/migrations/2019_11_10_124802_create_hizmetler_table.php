<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHizmetlerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hizmetler', function (Blueprint $table) {
                $table->bigIncrements('id')->unique();
                $table->string('hkod');
                $table->string('ad');
                $table->integer('fiyat')->nullable();
                $table->timestamps();
                $table->softDeletes();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hizmetler');
    }
}
