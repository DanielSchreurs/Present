<?php

    namespace App\Http\Controllers\Www;

    use App\Cour;
    use App\Occurrence;
    use App\School;
    use App\User;
    use Carbon\Carbon;
    use Dingo\Api\Http\Middleware\Auth;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Mail\Mailer;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\Redirect;
    use Jrean\UserVerification\Traits\VerifiesUsers;
    use Jrean\UserVerification\Facades\UserVerification;

    class UserController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
        }

        protected function generateConfirmMail()
        {
            $user = \Auth::user();
            UserVerification::generate($user);
            UserVerification::send($user, 'Veuillez valider votre adresse e-mail');
        }

        /**
         * @param         $id
         * @param Request $request
         */
        protected function postAvatar(Request $request)
        {
            $user = \Auth::user();
            $file = $request->file('avatar');
            $name = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
            \Storage::put(
                'user/original/' . $name,
                file_get_contents($request->file('avatar')->getRealPath())
            );
            $user->avatar = $name;
            $user->save();
        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $schools = \Auth::user()->schools;

            return view('teacher.teachers_index')->with(compact('schools'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            //
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            //
        }

        /**
         * Display the specified resource.
         *
         * @param  string $slug_user $slug_school
         *
         * @return \Illuminate\Http\Response
         */
        public function show($school_slug, $user_slug)
        {
            $user = School::findBySlugOrFail($school_slug)->users()->where('slug', '=', $user_slug)->firstOrFail();

            return view('teacher.show', compact('user'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            //
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $id
         *
         * @return \Illuminate\Http\Response
         */
        public function update(Requests\UpdateUserProfilRequest $request)
        {
            $iIsEmailUpdate = $request->email !== \Auth::user()->email;
            $endMessage = '';
            \Auth::user()->update($request->all());
            if (!is_null($request->file('avatar'))) {
                $this->postAvatar($request);
            }
            if ($iIsEmailUpdate) {
                $this->generateConfirmMail();
            }
            $endMessage = $iIsEmailUpdate ? ', un mail de confirmation a été envoyé à ' . \Auth::user()->email : '';
            \Flash::success('Votre profile a été mis à jour avec succès' . $endMessage . '.');

            return \Redirect::back();
        }

        public function updateTimeZoneConfig(Requests\UpdateUserTimeZoneRequest $request)
        {
            \Auth::user()->update($request->all());
            \Flash::success('Les plages horaires ont été mises à jour avec succès.');

            return \Redirect::back();
        }

        public function getDestroy()
        {
            return view('teacher.destroy');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy(Requests\ConfirmDestroyRequest $request, $id)
        {
            $user = User::findBySlugOrIdOrFail($id);
            \Auth::logout();
            $user->delete();
            \Flash::success('Votre compte a été supprimé avec succès.');

            return \Redirect::action('Auth\AuthController@getRegister');
        }

        /**
         * @param $id
         *
         * @return \Illuminate\Http\RedirectResponse
         */
        public function addUserToSchool($id)
        {
            if (!\Auth::user()->schools->contains($id)) {
                \Auth::user()->schools()->attach($id);
                \Flash::success('Votre demande d’adhésion est en cours de traitement.');
            } else {
                \Flash::error('Vous appartenez déjà à cette école');
            }

            return \Redirect::back();
        }

        /**
         * @return $this
         */
        public function getConfig()
        {
            return view('teacher.edit')->with('user', \Auth::user());
        }

        public function updatePassword(Requests\udateUserPasswordRequest $request)
        {
            \Auth::user()->update(['password' => bcrypt($request->password)]);
            \Flash::success('Le mot de passe a été redéfinit avec succès.');

            return redirect()->action('Www\UserController@getConfig');
        }

        public function confirm($confirmation_code)
        {
            \Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user) {
                $m->to($user->email, $user->name)->subject('Your Reminder!');
            });

            return Redirect::route('login_path');
        }

        public function getVerificationMail()
        {
            $this->generateConfirmMail();
            \Flash::success('Un mail de confirmation a été envoyé à l’adresse suivante : ' . \Auth::user()->email);

            return \Redirect::back();
        }

        public function getVerification(Request $request, $token)
        {
            $user = User::where('email', '=', $request->email)->where('verification_token', '=', $token);
            if (!empty($user->get()->toArray())) {
                $user->update(['verified' => 1]);
                \Flash::success('Votre adresse mail est validée!');
            } else {
                \Flash::error('Le lien de validation n’est pas valide.');
            }

            return redirect('/');

        }

        public function updateDisplayMeta(Requests\UpdateCreateViewStudents $request)
        {
            if (null !== $request->create_view_classe_nbr_pagination) {
                \Auth::user()->metas()->whereName('create_view_classe_nbr_pagination')->update(['value' => $request->create_view_classe_nbr_pagination]);
            }
            if (null !== $request->create_view_student_nbr_pagination) {
                \Auth::user()->metas()->whereName('create_view_student_nbr_pagination')->update(['value' => $request->create_view_student_nbr_pagination]);
            }
            if (null !== $request->create_view_cours_nbr_pagination) {
                \Auth::user()->metas()->whereName('create_view_cours_nbr_pagination')->update(['value' => $request->create_view_cours_nbr_pagination]);
            }
            if (null !== $request->create_view_classe_list_block) {
                \Auth::user()->metas()->whereName('create_view_classe_list_block')->update(['value' => $request->create_view_classe_list_block]);
            }
            if (null !== $request->create_view_student_list_block) {
                \Auth::user()->metas()->whereName('create_view_student_list_block')->update(['value' => $request->create_view_student_list_block]);
            }
            if (null !== $request->create_view_cours_list_block) {
                \Auth::user()->metas()->whereName('create_view_cours_list_block')->update(['value' => $request->create_view_cours_list_block]);
            }
            if (null !== $request->create_view_student_classe_id) {
                \Auth::user()->metas()->whereName('create_view_student_classe_id')->update(['value' => $request->create_view_student_classe_id]);
            }

            return \Redirect::back();
        }
        public function updateIndexMeta(Requests\UpdateIndexViewRequest $request)
        {
            if (null !== $request->index_view_classe_nbr_pagination) {
                \Auth::user()->metas()->whereName('index_view_classe_nbr_pagination')->update(['value' => $request->index_view_classe_nbr_pagination]);
            }
            if (null !== $request->index_view_student_nbr_pagination) {
                \Auth::user()->metas()->whereName('index_view_student_nbr_pagination')->update(['value' => $request->index_view_student_nbr_pagination]);
            }
            if (null !== $request->index_view_cours_nbr_pagination) {
                \Auth::user()->metas()->whereName('index_view_cours_nbr_pagination')->update(['value' => $request->index_view_cours_nbr_pagination]);
            }
            if (null !== $request->index_view_classe_list_block) {
                \Auth::user()->metas()->whereName('index_view_classe_list_block')->update(['value' => $request->index_view_classe_list_block]);
            }
            if (null !== $request->index_view_student_list_block) {
                \Auth::user()->metas()->whereName('index_view_student_list_block')->update(['value' => $request->index_view_student_list_block]);
            }
            if (null !== $request->index_view_cours_list_block) {
                \Auth::user()->metas()->whereName('index_view_cours_list_block')->update(['value' => $request->index_view_cours_list_block]);
            }
            if (null !== $request->index_view_student_classe_id) {
                \Auth::user()->metas()->whereName('index_view_student_classe_id')->update(['value' => $request->index_view_student_classe_id]);
            }

            return \Redirect::back();
        }
    }
