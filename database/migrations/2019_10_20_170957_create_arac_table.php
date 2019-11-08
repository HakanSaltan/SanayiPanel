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
            $table->string('plaka',150)->unique();
            $table->string('sase')->nullable();
            $table->integer('km')->nullable();
            $table->string('marka')->nullable();
            $table->string('model')->nullable();
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
