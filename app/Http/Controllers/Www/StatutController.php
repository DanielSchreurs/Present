<?php

    namespace App\Http\Controllers\Www;

    use App\Statut;
    use Dingo\Api\Http\Middleware\Auth;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Redirect;
    use Laracasts\Flash\Flash;

    class StatutController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view('configuration.config');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('configuration.config');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Requests\StoreStatutRequest $request)
        {
            $statut = \Auth::user()->statuts()->create($request->all());
            if (isset($request->update_default)) {
                $this->updateDefaultStatut($statut->id);
            }
            \Flash::success('Le Statut ' . $statut->name . ' a été créé avec succès.');

            return Redirect::back();
        }

        /**
         * Display the specified resource.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            return view('configuration.config');
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
            return view('configuration.config');
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $id
         *
         * @return \Illuminate\Http\Response
         */
        public function update(Requests\UpdateStatutRequest $request, $id)
        {
            $statut = Statut::findBySlugOrIdOrFail($id);
            $statut->update($request->all());
            if (isset($request->update_default)) {
                $this->updateDefaultStatut($statut->id);
            }
            \Flash::success('Le statut, ' . $statut->name . ', a été modifié avec succès.');

            return Redirect::back();
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            $statut = Statut::findBySlugOrIdOrFail($id);
            $used = $statut->presents->count();
            if (\Auth::user()->statuts()->count() < 3) {
                Flash::error('Le statut, ' . $statut->name . ', ne peut pas être supprimé, car il faut au minimum 2 statuts.');
            } elseif (!!$statut->is_default) {
                Flash::error('Le statut, ' . $statut->name . ', ne peut pas être supprimé, car il est statut par defaut.');
            } elseif ($used > 0) {
                Flash::error('Le statut, ' . $statut->name . ', ne peut pas être supprimé, car il est utilisé (' . $used . ' fois) dans vos graphiques.');
            } else {
                Flash::success('Le statut, ' . $statut->name . ', a été supprimé avec succès.');
                Statut::destroy($id);
            }

            return \Redirect::back();
        }

        public function updateDefault(Request $request)
        {
            $statut = $this->updateDefaultStatut($request->statut_id);
            Flash::success('Le statut, ' . $statut->name . ' est le statut par défaut');

            return \Redirect::action('Www\PageController@getConfig');
        }

        private function updateDefaultStatut($id)
        {
            \Auth::user()->statuts()->default()->update(['is_default' => '0']);
            $statut = Statut::findBySlugOrIdOrFail($id);
            $statut->update(['is_default' => '1']);

            return $statut;
        }
    }
