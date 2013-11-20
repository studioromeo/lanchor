<?php

use Illuminate\Database\Migrations\Migration;
use Anchor\Core\Models\Category;

class CreateCategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function($table)
        {
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->text('description')->nullable();
        });

        $category = new Category;
        $category->title = 'Uncategorised';
        $category->slug = 'uncategorised';
        $category->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('categories');
    }

}
