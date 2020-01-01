<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAracTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arac', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('musteri_id');
            $table->integer('user_id');
            $table->string('plaka',50)->nullable();
            $table->string('sase',50)->nullable();
            $table->string('km',50)->nullable();
            $table->string('marka',50)->nullable();
            $table->string('model',50)->nullable();
            $table->string('qrCode')->nullable();
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
        Schema::dropIfExists('arac');
    }
}
