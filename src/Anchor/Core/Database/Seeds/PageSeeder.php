<?php

namespace Anchor\Core\Database\Seeds;

use Hash;
use Seeder;
use Eloquent;
use Anchor\Core\Models\Page;
use Faker\Factory as Faker;

class PageSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $faker = Faker::create();

        foreach(range(1, 5) as $index) {

            $title = $faker->sentence(1);

            Page::create(array(
                'parent'       => 0,
                'slug'         => $this->generateSlug($title),
                'name'         => $title,
                'title'        => $title,
                'content'      => implode("\r\n\r\n", $faker->paragraphs(5)),
                'status'       => rand(1,3),
                'redirect'     => '',
                'show_in_menu' => rand(0,1),
                'menu_order'   => $index
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
