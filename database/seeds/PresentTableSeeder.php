<?php

    use Illuminate\Database\Seeder;

    class PresentTableSeeder extends Seeder
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
                $occurrences = $user->occurrences()->get();
                foreach ($occurrences as $occurrence) {
                    $students = \App\Classe::findOrFail($occurrence->classe->id)->students;
                    foreach ($students as $student) {
                        DB::table('presents')->insert([
                            'student_id'    => $student->id,
                            'occurrence_id' => $occurrence->id,
                            'statut_id'     => $faker->numberBetween($min = 1, $max = 3),
                            'created_at'    => \Carbon\Carbon::now(),
                            'updated_at'    => \Carbon\Carbon::now()
                        ]);
                    }
                }
            }
        }
    }
