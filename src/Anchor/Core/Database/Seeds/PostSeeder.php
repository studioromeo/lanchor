<?php

namespace Anchor\Core\Database\Seeds;

use Seeder;
use Anchor\Core\Models\Post;

class PostSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post;
        $post->fill(array(
            'title' => 'Hello World',
            'slug'  => 'hello-world',
            'description' => '',
            'author' => 1,
            'category' => 1,
            'status' => 'published',
            'comments' => 0
        ));

        $post->save();
    }

}
