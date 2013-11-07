<?php

use Illuminate\Database\Migrations\Migration;

class CreateExtendTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extend', function($table)
        {
            $table->increments('id');
            $table->enum('type', array('post','page'));
            $table->enum('field', array('text','html','image','file'));
            $table->string('key');
            $table->string('label');
            $table->text('attributes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('extend');
    }

}
