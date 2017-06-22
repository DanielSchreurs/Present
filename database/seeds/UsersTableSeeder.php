<?php

    use Illuminate\Database\Seeder;

    class UsersTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $faker = \Faker\Factory::create('fr_BE');
            foreach (range(1, config('app.iMaxUser')) as $index) {
                $name = $faker->unique()->firstName;
                DB::table('users')->insert([
                    'name'       => $name,
                    'slug'       => str_slug($name, '-'),
                    'email'      => $index . '@test.com',
                    'password'   => bcrypt('admin'),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
        }
    }
