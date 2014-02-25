<?php

namespace Anchor\Core\Database\Seeds;

use Seeder;
use Eloquent;
use Anchor\Core\Models\Metadata;
use Faker\Factory as Faker;

class MetadataSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $faker = Faker::create();

        $settings = array(
            'auto_published_comments' => 0,
            'comment_moderation_keys' => implode(',', $faker->words(8)),
            'comment_notifications' => 0,
            'description' => 'It’s not just any blog. It’s an Anchor blog.',
            'home_page' => 1,
            'posts_page' => 1,
            'posts_per_page' => rand(1,10),
            'sitename' => 'My First Anchor Blog',
            'theme' => 'default'
        );

        foreach ($settings as $key => $value) {
            Metadata::create(compact('key', 'value'));
        }


        foreach(range(1, 10) as $index) {
            $this->seedCustomData();
        }

    }

    public function seedCustomData($attempt = 1)
    {
        $faker = Faker::create();
        $attempt++;

        if ($attempt > 3) return;

        try {
            Metadata::create(array(
                'key' => 'custom_' . $faker->word(),
                'value' => $faker->sentence(1)
            ));
        } catch (\Illuminate\Database\QueryException $e) {
            $this->seedCustomData($attempt);
        }
    }
}
