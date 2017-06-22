<?php

    use Illuminate\Database\Seeder;

    class ClasseCourTableSeeder extends Seeder
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
                foreach ($user->cours as $cour) {
                    foreach ($user->classes as $classe) {
                        DB::table('classe_cour')->insert([
                            'cour_id'   => $cour->id,
                            'classe_id' => $classe->id,
                        ]);
                    }
                }
            }
        }
    }
