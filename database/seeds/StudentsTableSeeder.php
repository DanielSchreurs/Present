<?php

    use Illuminate\Database\Seeder;

    class StudentsTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $users = \App\User::all();
            foreach ($users as $user) {
                $faker = \Faker\Factory::create('fr_BE');
                $classes = $user->classes()->get();
                foreach ($classes as $classe) {
                    foreach (range(1, config('app.iMaxStudentsClasse')) as $index) {
                        $first_name = $faker->firstName;
                        $last_name = $faker->lastName;
                        $slug = $user->id . '-' . str_slug($first_name . ' ' . $last_name, '-');
                        DB::table('students')->insert([
                            'first_name' => $first_name,
                            'last_name'  => $last_name,
                            'slug'       => $slug,
                            'email'      => $slug . '@mail.com',
                            'user_id'    => $user->id,
                            'created_at' => \Carbon\Carbon::now(),
                            'updated_at' => \Carbon\Carbon::now(),
                        ]);
                    }
                }
            }
        }
    }
