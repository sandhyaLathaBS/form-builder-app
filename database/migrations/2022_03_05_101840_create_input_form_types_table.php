<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInputFormTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('input_form_types', function (Blueprint $table) {
            $table->id();
            $table->string('field');
            $table->string('type');
            $table->tinyInteger('choice')->comment('1-> has multiple options, 0-> options not available');
            $table->string('component');
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
        Schema::dropIfExists('input_form_types');
    }
}