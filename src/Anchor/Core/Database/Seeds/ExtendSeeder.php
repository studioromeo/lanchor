<?php

namespace Anchor\Core\Database\Seeds;

use Hash;
use Seeder;
use Eloquent;
use Anchor\Core\Models\Extend;
use Faker\Factory as Faker;

class ExtendSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $faker = Faker::create();

        foreach(range(1, 50) as $index) {

            $title = $faker->sentence(2);
            $field = rand(1,4);

            switch ($field) {
                case 4:
                    $attr = json_encode(array(
                        'type' => $faker->mimeType
                    ));
                    break;
                case 3:
                    $attr = json_encode(array(
                        'type' => $faker->mimeType,
                        'size' => array(
                            'width' => rand(1, 1000),
                            'height' => rand(1, 1000),
                        )
                    ));
                    break;
                default:
                    $attr = '';
            }

            Extend::create(array(
                'type'       => rand(1,2),
                'field'      => $field,
                'key'        => $faker->word,
                'label'      => $faker->word,
                'attributes' => $attr
            ));
        }
    }
}
