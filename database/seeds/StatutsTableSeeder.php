<?php

    use Illuminate\Database\Seeder;

    class StatutsTableSeeder extends Seeder
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
                foreach (config('app.defaultStatuts') as $statut) {
                    DB::table('statuts')->insert([
                        'user_id'    => $user->id,
                        'name'       => $statut['name'],
                        'color'      => $statut['color'],
                        'slug'       => $user->id . '-' . str_slug($statut['name'], '-'),
                        'is_default' => $statut['is_default'],
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now(),
                    ]);
                }
            }
        }
    }
