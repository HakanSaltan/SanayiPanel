<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHizmetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hizmet', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->integer('fatura_id');
            $table->integer('adet');
            $table->string('parca');
            $table->integer('parcaUcret')->nullable();
            $table->timestamp('tarih')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('hizmet');
    }
}
