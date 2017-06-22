<?php

    namespace App\Http\Controllers;

    use App\AuthenticateUser;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Session;

    class AuthController extends Controller
    {

        public function login(AuthenticateUser $authenticateUser, Request $request)
        {
            $authorizedDriver = ['github', 'facebook', 'twitter', 'google'];

            if (!is_null($request->driver)) {
                if (in_array($request->driver, $authorizedDriver)) {
                    \Session::put('driver', $request->driver);
                } else {
                    \Flash::error('Oups, le lien n’est pas valide.');

                    return \Redirect::back();
                }
            }
            if ($request->has('oauth_token')) {
                return $authenticateUser->execute($request->has('oauth_token'), \Session::get('driver'));
            }

            return $authenticateUser->execute($request->has('code'), \Session::get('driver'));
        }
    }
