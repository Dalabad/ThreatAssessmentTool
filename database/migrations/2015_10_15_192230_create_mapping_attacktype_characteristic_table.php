<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMappingAttacktypeCharacteristicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapping_attacktype_characteristic', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attacktype_id');
            $table->integer('characteristic_id');
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
        Schema::drop('mapping_attacktype_characteristic');
    }
}
