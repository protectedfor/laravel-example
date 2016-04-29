<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeWorksTranslatable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->dropColumn('description');
        });
        Schema::create('work_translations', function(Blueprint $table){
            $table->increments('id');
            $table->integer('work_id')->unsigned();

            $table->string('title');
            $table->text('description');
            $table->string('locale')->index();

            $table->unique(['work_id','locale']);
            $table->foreign('work_id')->references('id')->on('works')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('works', function (Blueprint $table) {
            $table->string('title');
            $table->text('description');
        });
        Schema::drop('work_translations');
    }
}
