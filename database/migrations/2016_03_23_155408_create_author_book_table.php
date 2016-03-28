<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books', function(Blueprint $table){
            $table->dropColumn('author_id');
        });
        Schema::create('author_book', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id');
            $table->integer('book_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books', function(Blueprint $table){
            $table->integer('author_id');
        });
        Schema::drop('author_book');
    }
}
