<?php

use Illuminate\Database\Migrations\Migration;

class CreatePageMetaTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_meta', function($table)
        {
            $table->increments('id');
            $table->integer('page');
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
        Schema::drop('page_meta');
    }

}
