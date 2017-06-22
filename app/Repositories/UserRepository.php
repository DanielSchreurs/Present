<?php
    /**
     * Created by PhpStorm.
     * User: danielschreurs
     * Date: 28/01/16
     * Time: 23:09
     */

    namespace app\Repositories;

    use App\User;

    class UserRepository
    {

        /**
         * @param $userData
         *
         * @return static
         */
        public function findByUsernameOrCreate($userData)
        {
            $userExist = User::whereEmail($userData->email)->first();
            if (!is_null($userExist)) {
                return $userExist;
            }

            $user = User::firstOrCreate([
                'email'  => $userData->email,
                'name'   => $userData->nickname ? $userData->nickname : $userData->name,
                'avatar' => $userData->avatar
            ]);
            
            foreach (config('app.defaultStatuts') as $statut) {
                $user->statuts()->create($statut);
            }
            foreach (config('app.defaultMetas') as $key => $value) {
                $user->metas()->create([
                    'value' => $value,
                    'name'  => $key
                ]);
            }

            return $user;

        }
    }