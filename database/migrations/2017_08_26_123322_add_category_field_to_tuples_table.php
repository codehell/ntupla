<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategoryFieldToTuplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tuples', function (Blueprint $table) {
            $table->unsignedInteger('category_id')->after('user_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tuples', function (Blueprint $table) {
            $table->dropForeign('tuples_category_id_foreign');
            $table->dropColumn('category_id');
        });
    }
}
