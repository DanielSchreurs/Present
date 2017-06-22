<?php
    /**
     * Created by PhpStorm.
     * User: danielschreurs
     * Date: 05/05/16
     * Time: 10:50
     */

    namespace app\Transformers;

    use App\User;
    use League\Fractal\TransformerAbstract;

    class UserTransformer extends TransformerAbstract
    {
        /**
         * @param User $user
         *
         * @return array
         */
        public function transform(User $user)
        {
            return [
                'id'     => (int)$user->id,
                'slug'   => $user->slug,
                'name'   => $user->name,
                'email'  => $user->email,
                'avatar' => $user->avatar
            ];
        }
    }