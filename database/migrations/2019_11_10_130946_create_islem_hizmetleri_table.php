<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIslemHizmetleriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('islem_hizmetleri', function (Blueprint $table) {
            $table->integer('islem_id');
            $table->integer('hizmet_id');
            $table->integer('adet');
            $table->integer('hizmet_fiyat');
            $table->integer('hizmet_kdv');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('islem_hizmetleri');
    }
}
