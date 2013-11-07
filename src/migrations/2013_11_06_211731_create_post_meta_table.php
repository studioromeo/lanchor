<?php

use Illuminate\Database\Migrations\Migration;

class CreatePostMetaTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_meta', function($table)
        {
            $table->increments('id');
            $table->integer('post');
            $table->integer('extend');
            $table->text('data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('post_meta');
    }

}
