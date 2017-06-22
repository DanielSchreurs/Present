<?php

    use Illuminate\Database\Seeder;

    class ClassesTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $faker = \Faker\Factory::create('fr_BE');
            $users = \App\User::all();
            foreach ($users as $user) {
                foreach (range(1, 5) as $index) {
                    $name = $faker->unique()->numberBetween($min = 2180, $max = 2386);
                    DB::table('classes')->insert([
                        'name'    => $name,
                        'slug'    => str_slug($name,'-'),
                        'user_id' => $user->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
                }
            }
        }
    }
