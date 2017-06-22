<?php

    namespace App\Http\Controllers\Www;

    use App\Classe;
    use App\Cour;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Support\Facades\View;
    use JavaScript;
    use App\Note;
    use App\Student;
    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;
    use Laracasts\Flash\Flash;
    use Maatwebsite\Excel\Excel;

    class StudentController extends Controller
    {
        public function __construct()
        {
            $this->middleware('auth');
            $this->importError = [];
            $this->importStudents = [];
        }

        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            return view('students.index');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('students.create', compact('classes', 'schools'));
        }

        /**
         * Store a newly created resource in storage.
         *
         * @return \Illuminate\Http\Response
         */
        public function store(Requests\StoreStudentRequest $request)
        {
            $student = new Student($request->all());
            \Auth::user()->students()->save($student);
            if (!is_null($request->file('avatar'))) {
                $this->postAvatar($request->file('avatar'), $student->id);
            }
            $student->classes()->attach($request->classes_id);
            Flash::success('L’élève ' . $student->fullname . ' a été créé avec succès.');

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
            $student = Student::findBySlugOrIdOrFail($slug);
            $notes = $student->notes;

            return view('students.student', compact('student', 'notes'));
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
            $student = Student::findBySlugOrIdOrFail($id);
            $meta = \Auth::user()->metas()->lists('value', 'name');
            $metaClasse = \Auth::user()->classes()->where('id', '=', $meta['create_view_student_classe_id'])->first();
            $students = \Auth::user()->students()->where('id', '!=', $student->id)->orderBy('updated_at', 'desc')->paginate($meta['create_view_student_nbr_pagination'] - 1);
            if (null != $metaClasse) {
                $students = $metaClasse->students()->where('id', '!=', $student->id)->orderBy('updated_at', 'desc')->paginate($meta['create_view_student_nbr_pagination'] - 1);
            }
            $isCreate = true;

            return view('students.edit', compact('student', 'students', 'meta', 'isCreate'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  int                      $slug
         *
         * @return \Illuminate\Http\Response
         */
        public function update(Requests\UpdateStudentRequest $request, $slug)
        {
            $student = Student::findBySlugOrIdOrFail($slug);
            $student->update($request->all());
            if (!is_null($request->file('avatar'))) {
                ;
                $this->postAvatar($request->file('avatar'), $student->id);
            }
            \Flash::success('L’élève ' . $student->fullname . ' a été modifié avec succès');
            if ($request->isOnProfil == true) {
                return \Redirect::action('Www\StudentController@show', $student->slug);
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
            $student = Student::findBySlugOrIdOrFail($id);
            Flash::success('L’élève, ' . $student->fullname . ' a été supprimé avec succès.');
            $student->delete();
            if (isset($request->redirect_back)) {
                if ($request->redirect_back == 1) {
                    return \Redirect::back();
                }
            }

            return \Redirect::action('Www\StudentController@index');
        }

        public function storeNote(Requests\StoreNoteRequest $request)
        {
            $note = new Note($request->all());
            \Auth::user()->notes()->save($note);

            \Flash::success('La note a été ajouté avec succès.');

            return \Redirect::back();
        }

        public function destroyNote($id)
        {
            $note = Note::findOrFail($id);
            \Flash::success('La note du' . $note->created_at->formatLocalized('%D') . 'a été supprimée avec succès.');
            $note->delete();

            return \Redirect::back();
        }

        public function updatetNote(Requests\UpdateNoteStudentRequest $request, $id)
        {
            $note = Note::findOrFail($id);
            $note->update($request->all());
            \Flash::success('La note ' . $note->created_at->formatLocalized('%D') . ' a bien été mise à jour avec succès');

            return \Redirect::back();
        }

        public function getImportStudentsList()
        {
            return view('students.import');
        }

        public function importStudentsList(Requests\ImportStudentCsvFile $request, $file = NULL, $classe_id = null)
        {
            $this->importError = [];
            $this->importStudents = [];
            if (app('App\Http\Controllers\Www\FileController')->isValideExelFile(null == $request->file('student_list') ? $file : $request->file('student_list'))) {
                \Excel::load(null == $request->file('student_list') ? $file : $request->file('student_list'), function ($reader) {
                    $line = 1;
                    $students = $reader->get();
                    foreach ($students as $studentrow) {
                        // TODO:: test if is a blank line
                        if (true) {
                            $validator = Validator::make($studentrow->toArray(), [
                                'first_name' => 'required|string|max:250|min:2',
                                'last_name'  => 'required|string|max:250|min:2',
                                'email'      => 'required|e-mail|max:250|unique:students,email,NULL,id,user_id,' . Auth::user()->id
                            ]);
                            if ($validator->fails()) {
                                //$validator->getMessageBag()->add('first_name-1', 'Password wrong');
                            }
                            $this->importStudents[ $line ] = $studentrow->toArray();
                            $line++;
                        }
                    }
                });
                \Session::put('importStudent', $this->importStudents);
                \Session::put('classe_id', null !== $classe_id ? $classe_id : $request->classe_id);

                return \Redirect::action('Www\StudentController@getValidateStudentImport');
            }
            \Flash::error('Ce n’est pas une fichier de type, .csv');

            return \Redirect::back();
        }

        public function getValidateStudentImport()
        {
            return View::make('students.validate-import')->with(['studentImport' => session('importStudent')]);
        }

        public function storeValidatedInport(Requests\ImportValideStudents $request)
        {
            $nbrStudent = 1;
            for ($i = 1; $i < $request->nbr; $i++) {
                if (null == \Request::input('remove_user-' . $i)) {
                    $student = \Auth::user()->students()->create([
                        'first_name' => \Request::input('first_name-' . $i),
                        'last_name'  => \Request::input('last_name-' . $i),
                        'email'      => \Request::input('email-' . $i)
                    ]);
                    if (!empty(\Request::input('classe_id-' . $i))) {
                        Classe::findBySlugOrIdOrFail(\Request::input('classe_id-' . $i))->students()->attach($student);
                    }
                    if (!is_null($request->file('avatar-' . $i))) {
                        $this->postAvatar($request->file('avatar-' . $i), $student->id);
                    }
                    $nbrStudent++;
                }
            }
            \Session::forget('importStudent');
            \Session::forget('classe_id');
            \Flash::success('Les ' . ($nbrStudent - 1) . ' élèves ont été créer avec succès.');

            return Redirect::action('Www\StudentController@index');
        }

        public function getStudentFromClasse($id)
        {
            return Classe::findBySlugOrIdOrFail($id)->students;
        }

        /**
         * @param Request $request
         * @param         $id
         *
         * @return bool
         */
        protected function postAvatar($file, $id)
        {
            $student = Student::findBySlugOrIdOrFail($id);
            $name = md5($file->getClientOriginalName() . time()) . '.' . $file->getClientOriginalExtension();
            \Storage::put(
                'students/original/' . $name,
                file_get_contents($file->getRealPath())
            );
            $student->avatar = $name;

            return $student->save();
        }

    }
