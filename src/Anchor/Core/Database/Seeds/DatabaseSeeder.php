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

        $this->call('Anchor\\Core\\Database\\Seeds\\CategorySeeder');
        $this->command->info('Category table seeded!');

        $this->call('Anchor\\Core\\Database\\Seeds\\PostSeeder');
        $this->command->info('Post table seeded!');

        $this->call('Anchor\\Core\\Database\\Seeds\\UserSeeder');
        $this->command->info('User table seeded!');

        $this->call('Anchor\\Core\\Database\\Seeds\\PageSeeder');
        $this->command->info('Page table seeded!');

        $this->call('Anchor\\Core\\Database\\Seeds\\MetadataSeeder');
        $this->command->info('Metadata table seeded!');

        $this->call('Anchor\\Core\\Database\\Seeds\\CommentSeeder');
        $this->command->info('Comment table seeded!');

        $this->call('Anchor\\Core\\Database\\Seeds\\ExtendSeeder');
        $this->command->info('Extend table seeded!');
    }

}
