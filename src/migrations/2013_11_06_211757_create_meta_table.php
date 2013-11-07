<?php

use Illuminate\Database\Migrations\Migration;

class CreateMetaTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta', function($table)
        {
            $table->string('key')->unique()->primary();
            $table->text('value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('meta');
    }

}
