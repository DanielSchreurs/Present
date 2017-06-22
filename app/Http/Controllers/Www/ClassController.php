<?php

    namespace App\Http\Controllers\Www;

    use App\Classe;
    use App\Student;
    use Carbon\Carbon;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Pagination\Paginator;
    use Laracasts\Flash\Flash;
    use Maatwebsite\Excel\Facades\Excel;

    class ClassController extends Controller
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
            return view('classe.index');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            $schools = \Auth::user()->schools->lists('name', 'id');

            return view('classe.create', compact('schools'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Requests\StoreClassRequest $request)
        {
            $classe = new Classe($request->all());
            \Auth::user()->classes()->save($classe);
            $this->addStudentsToClasse($classe->slug, $request->students_id);
            \Flash::success('La classe, ' . $classe->name . ', a été créée avec succès.');
            if (null !== $request->file('student_list')) {
                return app('App\Http\Controllers\Www\StudentController')->importStudentsList(new Requests\ImportStudentCsvFile($request->all()), $request->file('student_list'), $classe->id);
            }

            //$this->addOrImportStudentsToClasse($request, $classe->slug);

            return \Redirect::back();
        }

        private function addStudentsToClasse($classe_slug, $students_id)
        {
            if (!is_null($students_id)) {
                $classe = Classe::findBySlugOrIdOrFail($classe_slug);
                $classe->students()->sync($students_id);
            }
        }

        public function importStudentToClasse(Requests\StoreStudentToClasse $request, $classe_slug)
        {
            $classe = Classe::findBySlugOrIdOrFail($classe_slug);
            $classe->students()->attach($request->students_id);
            if (!is_null(\Input::file('student_list'))) {
                $filePath = $request->file('student_list')->getPathName();
                $this->importStudentsList($filePath, $classe);
            }
            Flash::success('Les élèves ont été ajoutés avec succès à la classe ' . $classe->name);

            return redirect()->action('Www\PageController@dashboard');
        }

        public function getAddStudentToClass($slug)
        {
            $students = \Auth::user()->students->lists('fullname', 'id');
            $classe = Classe::findBySlugOrIdOrFail($slug);
            $selected_student = $classe->students->lists('id')->toArray();

            return view('students.import', compact('classe', 'students', 'selected_student'));
        }

        public function addStudentToClasse(Requests\StoreStudentToClasse $request, $classe_slug)
        {
            $this->addOrImportStudentsToClasse($request, $classe_slug);
            Flash::success('Les élèves ont été ajoutés avec succès à la classe ' . Classe::findBySlugOrIdOrFail($classe_slug)->name);

            return redirect()->action('Www\PageController@dashboard');
        }

        protected function addOrImportStudentsToClasse($request, $classe_slug)
        {
            $classe = Classe::findBySlugOrIdOrFail($classe_slug);
            if (!is_null($request->students_id)) {
                $classe->students()->sync($request->students_id);
            }
            if (!is_null($request->file('student_list'))) {
                $filePath = $request->file('student_list')->getPathName();
                $this->importStudentsList($filePath, $classe);
            }
            $classe->update(['updated_at' => Carbon::now()]);
        }

        public function importStudentsList($studentsFilePath, $classe)
        {
            $import = Excel::load($studentsFilePath);
            $students = $import->get();

            foreach ($students as $studentrow) {
                $student = \Auth::user()->students()->create([

                    'first_name' => $studentrow->first_name,
                    'last_name'  => $studentrow->last_name,
                    'email'      => $studentrow->email
                ]);
                $classe->students()->attach($student);
            }
            Flash::success('La classe, ' . $classe->name . ', a été créée avec succès et les élève ont été ajoutés.');

            return redirect()->action('Www\PageController@dashboard');
        }

        /**
         * Display the specified resource.
         *
         * @param  int $$slug
         *
         * @return \Illuminate\Http\Response
         */
        public function show($slug)
        {
            $classe = Classe::findBySlugOrIdOrFail($slug);
            $studentsPagination = $classe->students()->alphabetic()->paginate(9);

            return view('classe.classe', compact('classe', 'studentsPagination'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int $slug
         *
         * @return \Illuminate\Http\Response
         */
        public function edit($slug)
        {
            $meta = \Auth::user()->metas()->lists('value', 'name');
            $classe = Classe::findBySlugOrIdOrFail($slug);
            $selected_student = $classe->students()->orderBy('first_name', 'asc')->get()->lists('id')->toArray();
            $classes = \Auth::user()->classes()->orderBy('updated_at', 'desc')->where('id', '!=', $classe->id)->paginate($meta['create_view_classe_nbr_pagination'] - 1);
            $isCreate = true;

            return view('classe.edit', compact('selected_student', 'classe', 'classes', 'meta', 'isCreate'));
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

            $classe = Classe::findBySlugOrIdOrFail($id);
            $classe->update($request->all());
            $this->addStudentsToClasse($classe->slug, $request->students_id);
            Flash::success('La classe a été modifiée avec succès.');
            if (null !== $request->file('student_list')) {
                return app('App\Http\Controllers\Www\StudentController')->importStudentsList(new Requests\ImportStudentCsvFile($request->all()), $request->file('student_list'), $classe->id);
            }

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
            $classe = Classe::findBySlugOrIdOrFail($id);
            Flash::success('La classe, ' . $classe->name . ', a été supprimmée avec succès.');
            Classe::destroy($id);
            if (isset($request->rediect)) {
                if ($request->rediect == 'index') {
                    return \Redirect::action('Www\ClassController@index');
                }
            }

            return \Redirect::back();
        }
    }
