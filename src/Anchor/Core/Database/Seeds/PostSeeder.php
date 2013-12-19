<?php

namespace Anchor\Core\Database\Seeds;

use Seeder;
use Eloquent;
use Anchor\Core\Models\Post;
use Faker\Factory as Faker;

class PostSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $faker = Faker::create();

        foreach(range(1, 20) as $index) {

            $title = $faker->sentence(5);

            $categories = \Anchor\Core\Models\Category::lists('title', 'id');

            Post::create(array(
                'title' => $title,
                'slug'  => $this->generateSlug($title),
                'description' => $faker->paragraph(2),
                'html' => implode("\r\n\r\n", $faker->paragraphs(5)), // @todo a bit more markdown!
                'author' => 1,
                'category' => array_rand($categories),
                'status' => rand(1,3),
                'comments' => rand(0,1)
            ));
        }
    }

    /**
     * [generateSlug description]
     * @param  [type] $str [description]
     * @return [type]      [description]
     */
    protected function generateSlug($str)
    {
        $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);
        $clean = strtolower(trim($clean, '-'));
        $clean = preg_replace("/[\/_|+ -]+/", '-', $clean);

        return $clean;
    }

}
