<?php

    namespace App\Http\Controllers\Www;

    use App\School;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Redirect;
    use Laracasts\Flash\Flash;

    class SchoolController extends Controller
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
            return view('schools.index');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            \Session::flash('redirect_route_name', \Input::get('memory-route'));

            return view('schools.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Requests\StoreSchoolRequest $request)
        {
            $school = new School($request->all());
            \Auth::user()->schools()->save($school);
            Flash::success('L’école ' . $school->name . ' a été créé avec succès.');
            if (\Session::get('redirect_route_name')) {
                return \Redirect::route(\Session::get('redirect_route_name'));
            }

            return \Redirect::back();
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
            //
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
        public function update(Request $request, $id)
        {
            //
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
            $school = School::findBySlugOrIdOrFail($id);
            Flash::success('L’école ' . $school->name . ' vient d’être supprimé avec succès.');
            School::destroy($id);

            return \Redirect::back();
        }

    }
