<?php

namespace Anchor\Core\Database\Seeds;

use Hash;
use Seeder;
use Eloquent;
use Anchor\Core\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $faker = Faker::create();

        User::create(array(
            'username'  => 'admin',
            'password'  => Hash::make('1234'),
            'email'     => $faker->email,
            'real_name' => 'Admin',
            'bio'       => $faker->paragraph(2),
            'status'    => rand(1,2),
            'role'      => rand(1,3)
        ));

        foreach(range(1, 5) as $index) {

            User::create(array(
                'username'  => $faker->username,
                'password'  => Hash::make('1234'),
                'email'     => $faker->email,
                'real_name' => $faker->name,
                'bio'       => $faker->paragraph(2),
                'status'    => rand(1,2),
                'role'      => rand(1,3)
            ));
        }
    }
}
