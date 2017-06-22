<?php

    use Illuminate\Database\Seeder;
    use Illuminate\Database\Eloquent\Model;

    class DatabaseSeeder extends Seeder
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            Model::unguard();

            $this->call(UsersTableSeeder::class);
            $this->call(StatutsTableSeeder::class);
            $this->call(ClassesTableSeeder::class);
            $this->call(CoursTableSeeder::class);
            $this->call(StudentsTableSeeder::class);
            $this->call(ClasseStudentTableSeeder::class);
            $this->call(ClasseCourTableSeeder::class);
            $this->call(OccurrencesTableSeeder::class);
            $this->call(PresentTableSeeder::class);
            $this->call(MetaTableSeeder::class);

            Model::reguard();
        }
    }
