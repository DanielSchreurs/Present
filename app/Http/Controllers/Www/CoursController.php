<?php

    namespace App\Http\Controllers\Www;

    use App\Cour;
    use App\Occurrence;
    use App\School;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Laracasts\Flash\Flash;

    class CoursController extends Controller
    {
        /**
         * ClassController constructor.
         */
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
            return view('cours.index', compact('cours'));

        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('cours.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Requests\StoreCoursRequest $request)
        {
            $cour = new Cour($request->all());
            \Auth::user()->cours()->save($cour);
            $cour->classes()->attach($request->classes_id);
            Flash::success('Le cours ' . $cour->name . 'a été créé avec succès.');
            if (session('start_step') == 2) {
                return redirect()->action('Www\UserController@getStarted', ['start_step' => 3]);
            }

            return \Redirect::back();
        }

        /**
         * Display the specified resource.
         *
         * @param  int $slug
         *
         * @return \Illuminate\Http\Response
         */
        public function show($slug)
        {
            $cour = \Auth::user()->cours()->where('slug', '=', $slug)->firstOrfail();
            $classesPagination = $cour->classes()->orderBy('updated_at', 'desc')->paginate(6);
            $user = \Auth::user();

            return view('cours.cours')->with(compact('cour', 'classesPagination', 'user'));
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
            $meta = \Auth::user()->metas()->lists('value', 'name');
            $cour = Cour::findBySlugOrIdOrFail($id);
            $cours = \Auth::user()->cours()->orderBy('updated_at', 'desc')->where('id', '!=', $cour->id)->paginate($meta['create_view_cours_nbr_pagination'] - 1);
            $isCreate = true;

            return view('cours.edit', compact('cour', 'cours', 'meta', 'isCreate'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $id
         *
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, $id)
        {
            $cour = Cour::findBySlugOrIdOrFail($id);
            $cour->update($request->all());

            \Flash::success('Le cours, ' . $cour->name . ', a été modifié avec succès.');

            return \Redirect::back();
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int $id
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy(Request $request, $id)
        {
            $cours = Cour::findBySlugOrIdOrFail($id);
            Flash::success('Le cours, ' . $cours->name . ', vient d’être supprimé.');
            Cour::destroy($id);
            if (isset($request->rediect)) {
                if ($request->rediect == 'index') {
                    return \Redirect::action('Www\CoursController@index');
                }
            }

            return \Redirect::back();
        }
    }
