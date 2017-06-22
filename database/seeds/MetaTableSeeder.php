<?php

    use Illuminate\Database\Seeder;

    class MetaTableSeeder extends Seeder
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
                foreach (config('app.defaultMetas') as $key => $value) {
                    DB::table('meta')->insert([
                        'value'   => $value,
                        'name'    => $key,
                        'user_id' => $user->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
                }
            }
        }
    }
