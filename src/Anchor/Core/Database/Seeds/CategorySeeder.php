<?php

namespace Anchor\Core\Database\Seeds;

use Hash;
use Seeder;
use Eloquent;
use Anchor\Core\Models\Category;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $faker = Faker::create();

        foreach(range(1, 3) as $index) {

            $title = $faker->sentence(2);

            Category::create(array(
                'title'       => $title,
                'slug'        => $this->generateSlug($title),
                'description' => $faker->paragraph(2)
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
