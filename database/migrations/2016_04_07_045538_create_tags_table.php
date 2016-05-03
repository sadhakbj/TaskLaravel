<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'tags',
            function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->timestamps();
            }
        );

        Schema::create(
            'article_tag',
            function ($table) {
                $table->integer('article_id')->unsigned();
                $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
                $table->integer('tag_id')->unsigned();
                $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
                $table->timestamps();

            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tags');
        Schema::drop('article_tag');
    }
}
