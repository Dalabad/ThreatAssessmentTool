<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMappingCharacteristicToolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mapping_characteristic_tool', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('characteristic_id');
            $table->integer('tool_id');
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
        Schema::drop('mapping_characteristic_tool');
    }
}
