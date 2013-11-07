<?php

use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function($table)
        {
            $table->increments('id');
            $table->string('parent');
            $table->string('slug');
            $table->string('name');
            $table->string('title');
            $table->text('content');
            $table->enum('status', array('draft','published','archived'));
            $table->text('redirect');
            $table->boolean('show_in_menu');
            $table->integer('menu_order');
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
        Schema::drop('pages');
    }

}
