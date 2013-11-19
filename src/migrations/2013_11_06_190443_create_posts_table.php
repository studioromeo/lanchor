<?php

use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function($table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->text('html')->nullable();
            $table->text('css')->nullable();
            $table->text('js')->nullable();
            $table->timestamps();
            $table->integer('author');
            $table->integer('category');
            $table->enum('status', array('draft','published','archived'));
            $table->boolean('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }

}
