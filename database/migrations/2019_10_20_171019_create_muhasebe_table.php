<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuhasebeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muhasebe', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tarihArac');
            $table->integer('parcaToplamUcret')->nullable();
            $table->integer('iscilik')->nullable();
            $table->integer('toplamUcret')->nullable();
            $table->integer('alinanUcret')->nullable();
            $table->integer('kalanUcret')->nullable();            
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
        Schema::dropIfExists('muhasebe');
    }
}
