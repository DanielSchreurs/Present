<?php

    use Illuminate\Database\Seeder;

    class ClasseStudentTableSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $i = 1;
            $users = \App\User::all();
            foreach ($users as $user) {
                $classes = $user->classes()->get();
                foreach ($classes as $classe) {
                    foreach (range(1, config('app.iMaxStudentsClasse')) as $index){
                        DB::table('classe_student')->insert([
                            'classe_id'  => $classe->id,
                            'student_id' => $i,
                        ]);
                        $i++;
                    }
                }
            }
        }
    }
