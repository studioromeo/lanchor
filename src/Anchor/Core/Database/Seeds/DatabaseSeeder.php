<?php

namespace Anchor\Core\Database\Seeds;

use Seeder;
use Eloquent;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('Anchor\\Core\\Database\\Seeds\\PostSeeder');
        $this->command->info('Post table seeded!');
    }

}
