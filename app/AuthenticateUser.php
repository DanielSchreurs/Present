<?php
    /**
     * Created by PhpStorm.
     * User: danielschreurs
     * Date: 28/01/16
     * Time: 22:05
     */

    namespace App;

    use App\Repositories\UserRepository as UserRepository;
    use Illuminate\Support\Facades\Session;
    use Laravel\Socialite\Contracts\Factory as Socialite;
    use Illuminate\Contracts\Auth\Guard as Authenticator;
    use Illuminate\Http\Request;

    class AuthenticateUser
    {
        /**
         * @var UserRepository
         */
        private $user;
        /**
         * @var Socialite
         */
        private $socialite;
        /**
         * @var AuthenticateUser
         */
        private $auth;

        public function __construct(UserRepository $user, Socialite $socialite, Authenticator $auth, Request $request)
        {
            $this->user = $user;
            $this->socialite = $socialite;
            $this->auth = $auth;
            $this->driver = '';
        }

        public function execute($hasCode, $driver)
        {
            $this->driver = $driver;
            if (!$hasCode) {
                return $this->getAuthorizationFirst();
            }
            $user = $this->user->findByUsernameOrCreate($this->getSocialbUser());
            $this->auth->login($user, true);

            return redirect('/');
        }

        private function getSocialbUser()
        {
            return $this->socialite->driver($this->driver)->user();
        }

        /**
         * @return \Symfony\Component\HttpFoundation\RedirectResponse
         */
        private function getAuthorizationFirst()
        {
            return $this->socialite->driver($this->driver)->redirect();
        }
    }