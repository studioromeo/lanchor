<?php

namespace Anchor\Core\Database\Seeds;

use Hash;
use Seeder;
use Eloquent;
use Anchor\Core\Models\Comment;
use Faker\Factory as Faker;

class CommentSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $faker = Faker::create();

        foreach(range(1, 40) as $index) {

            Comment::create(array(
                'post' => rand(1,20),
                'status' => rand(1,3),
                'date' => $faker->dateTime,
                'name' => $faker->name,
                'email' => $faker->email,
                'text' => implode("\r\n\r\n", $faker->paragraphs(rand(1,5)))
            ));
        }
    }
}
