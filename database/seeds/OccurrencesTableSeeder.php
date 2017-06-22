<?php

    use Illuminate\Database\Seeder;

    class OccurrencesTableSeeder extends Seeder
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
                foreach ($user->classes as $classe) {
                    foreach ($classe->cours as $cour) {
                        $start_period = \Carbon\Carbon::createFromDate(2016, 6, 1, 'Europe/London');
                        $end_period = \Carbon\Carbon::createFromDate(2016, 6, 30, 'Europe/London');
                        $day = $faker->numberBetween(0, 4);
                        while ($start_period->lte($end_period)) {
                            if ($start_period->dayOfWeek == $day) {
                                DB::table('occurrences')->insert([
                                    'from'       => $start_period,
                                    'to'         => $end_period,
                                    'day'        => $day,
                                    'from_hour'  => $start_period,
                                    'to_hour'    => $end_period,
                                    'cour_id'    => $cour->id,
                                    'classe_id'  => $classe->id,
                                    'user_id'    => $user->id,
                                    'is_closed'  => 1,
                                    'created_at' => \Carbon\Carbon::now(),
                                    'updated_at' => \Carbon\Carbon::now(),
                                ]);
                            }
                            $start_period->addDay(1);
                        }
                    }
                }
            }
        }
    }
