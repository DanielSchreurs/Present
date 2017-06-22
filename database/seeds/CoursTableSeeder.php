<?php

    use Illuminate\Database\Seeder;

    class CoursTableSeeder extends Seeder
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
                foreach (config('app.coursTable') as $index) {
                    DB::table('cours')->insert([
                        'name'        => $index,
                        'description' => $faker->sentence(6),
                        'slug'        => $user->id . '-' . str_slug($index, '-'),
                        'user_id'     => $user->id,
                        'created_at'  => \Carbon\Carbon::now(),
                        'updated_at'  => \Carbon\Carbon::now(),
                    ]);
                }
            }
        }
    }
