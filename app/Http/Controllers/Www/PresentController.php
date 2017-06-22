<?php

    namespace App\Http\Controllers\Www;

    use App\Classe;
    use App\Cour;
    use App\Occurrence;
    use App\Present;
    use Carbon\Carbon;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;

    class PresentController extends Controller
    {

        /**
         * PresentController constructor.
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
            return view('seances.index');
        }

        public function getAllStudentfromOneOccurrence($id)
        {
            $occurrence = Occurrence::findOrfail($id);
            $cours_id = $occurrence->cour_id;
            $cour = Cour::findOrFail($cours_id);
            $classe_id = Occurrence::findOrfail($id)->classe_id;
            $students = Classe::findOrFail($classe_id)->students()->alphabetic()->get();
            $statuts = \Auth::user()->statuts()->oderByDefault()->get();
            $defaultStatut = \Auth::user()->statuts()->default()->first();

            return view('seances.occurrence', compact('cour', 'students', 'occurrence', 'statuts', 'defaultStatut'));
        }

        public function editAllStudentfromOneOccurrence($id)
        {
            $occurrence = Occurrence::findOrfail($id);
            $cours_id = $occurrence->cour_id;
            $cour = Cour::findOrFail($cours_id);
            $statuts = \Auth::user()->statuts()->oderByDefault()->get();
            $defaultStatut = \Auth::user()->statuts()->default()->first();

            return view('seances.occurrence--edit', compact('cour', 'occurrence', 'statuts', 'defaultStatut'));
        }

        public function editClassePresent(Request $request, $id)
        {
            foreach (\Input::except(['_token', '_method']) as $key => $value):
                $data = explode('-', $key);
                Present::findOrFail($data[0])->update([
                    'student_id'    => $data[1],
                    'occurrence_id' => $id,
                    'statut_id'     => $value
                ]);
            endforeach;
            \Flash::success('Les présences du cours '.Occurrence::findOrFail($id)->cour->name.', ont été mises à jour avec succès.');
            return redirect()->action('Www\PresentController@index');
        }

        public function storeClassePresent(Request $request, $id)
        {
            foreach (\Input::except(['_token', '_method']) as $key => $value):
                Present::create([
                    'student_id'    => $key,
                    'occurrence_id' => $id,
                    'statut_id'     => $value
                ]);
            endforeach;
            \DB::table('occurrences')
                ->where('id', $id)
                ->update(['is_closed' => true]);
            \Flash::success('Les présences ont été prises avec succès.');

            return redirect()->action('Www\PresentController@index');
        }

        public function getPlanificateFull()
        {
            \JavaScript::put([
                "user" => \Auth::user()->get()
            ]);

            return view('seances.create_full_seance');
        }

        public function getPlanificateFullWithCours($cours_slug)
        {
            $class = \Auth::user()->classes->lists('name', 'id');
            $cours = \Auth::user()->cours->lists('name', 'id');
            $schools = \Auth::user()->schools->lists('name', 'id');
            $cour = Cour::findBySlugOrIdOrFail($cours_slug);

            return view('seances.create_full_seance', compact('class', 'cours', 'schools', 'cour'));
        }

        public function storePlanificateFull(Requests\storeFullPlanification $request)
        {
            $start_period = new Carbon($request->from);
            $end_period = new Carbon($request->to);
            $day = $request->day;
            $cour = Cour::findBySlugOrIdOrFail($request->cour_id);
            $i = 0;
            while ($start_period->lte($end_period)) {
                if ($start_period->dayOfWeek == $day) {
                    \Auth::user()->occurrences()->save(
                        new Occurrence([
                            'from'      => $start_period,
                            'to'        => $end_period,
                            'day'       => $request->day,
                            'from_hour' => $request->from_hour,
                            'to_hour'   => $request->to_hour,
                            'cour_id'   => $request->cour_id,
                            'classe_id' => $request->classe_id,
                        ])
                    );
                    $i++;
                }
                $start_period->addDay(1);
            }
            // bind cours to classe
            if (!$cour->classes->contains($request->classe_id)) {
                $cour->classes()->attach($request->classe_id);
            }
            \Flash::success($i . ' nouvelles séances ont été créées avec succès.');

            return redirect()->action('Www\PageController@dashboard');
        }

        public function getPlanificateStepOne()
        {
            return view('seances.tunnel.planificateCours.list_schools')->with('schools', \Auth::user()->schools->lists('name', 'id'));
        }

        public function storePlanificateStepOne(Request $request)
        {
            \Session::put('schools_id', $request->input('schools_id'));

            return redirect()->action('Www\UserController@getPlanificateStepTwo');
        }

        public function getPlanificateStepTwo()
        {
            return view('seances.tunnel.planificateCours.list_cours')->with('cours', \Auth::user()->cours->lists('name', 'id'));
        }

        public function storePlanificateStepTwo(Request $request)
        {

            \Session::put('cours_id', $request->input('cours_id'));

            return redirect()->action('Www\UserController@getPlanificateStepThree');
        }

        public function getPlanificateStepThree()
        {
            return view('seances.tunnel.planificateCours.list_class')->with('class', \Auth::user()->classes->lists('name', 'id'));
        }

        public function storePlanificateStepThree(Request $request)
        {
            \Session::put('classes_id', $request->input('classes_id'));

            return redirect()->action('Www\UserController@getPlanificateStepFour');
        }

        public function getPlanificateStepFour()
        {
            return view('seances.tunnel.planificateCours.summary')->with('session', \Session::all());
        }

        public function storePlanification(Request $request)
        {
            dd($request->all());
            Occurrence::create([
                'cour_id' => \Session::get('cours_id')[0]
            ]);
            \Flash::success('La planification a été créé avec succès.');

            return redirect()->action('Www\PageController@dashboard');
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

            $occurrence = Occurrence::findOrFail($id);
            \Flash::success('La séance du, ' . $occurrence->from_hour->formatLocalized('%A %d %B %Y') . ' a été supprimé avec succès.');
            $occurrence->delete();
            if (isset($request->redirect_back)) {
                if ($request->redirect_back == 1) {
                    return \Redirect::back();
                }
            }

            return \Redirect::action('Www\PresentController@index');
        }


    }
