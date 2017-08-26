<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectorTupleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selector_tuple', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tuple_id');
            $table->foreign('tuple_id')->references('id')->on('tuples')->onDelete('cascade');
            $table->unsignedInteger('selector_id');
            $table->foreign('selector_id')->references('id')->on('selectors')->onDelete('cascade');
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
        Schema::dropIfExists('selector_tuple');
    }
}
