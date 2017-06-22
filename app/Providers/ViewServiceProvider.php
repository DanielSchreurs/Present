<?php

    namespace App\Providers;

    use App\School;
    use App\Student;
    use App\User;
    use Illuminate\Pagination\Paginator;
    use Illuminate\Support\Facades\Auth;
    use View;
    use Illuminate\Support\ServiceProvider;

    class ViewServiceProvider extends ServiceProvider
    {
        /**
         * Bootstrap the application services.
         *
         * @return void
         */
        public function boot()
        {
            view()->composer('teacher.*', function ($view) {
                $nav = 'dashboard';
                $view->with(compact('nav'));
            });
            view()->composer('cours.*', function ($view) {
                $nav = 'cours';
                $view->with(compact('nav'));
            });
            view()->composer('students.*', function ($view) {
                $nav = 'students';
                $view->with(compact('nav'));
            });
            view()->composer('classe.*', function ($view) {
                $nav = 'classes';
                $view->with(compact('nav'));
            });
            view()->composer('configuration.*', function ($view) {
                $nav = 'config';
                $view->with(compact('nav'));
            });
            view()->composer('schools.*', function ($view) {
                $nav = 'schools';
                $view->with(compact('nav'));
            });
            view()->composer('seances.*', function ($view) {
                $nav = 'seances';
                $view->with(compact('nav'));
            });
            view()->composer('search.*', function ($view) {
                $nav = 'dashboard';
                $view->with(compact('nav'));
            });

            View::composer('layouts.teacher_layout', function ($view) {
                $user = \Auth::user();
                $schools = \Auth::user()->schools;
                $view->with(compact('user', 'schools'));
            });
            View::composer('modals.dashbord.students', function ($view) {
                $students = \Auth::user()->students()->paginate(3, ['*'], 'more_student');
                $view->with(compact('students'));
            });
            View::composer('modals.dashbord.classes', function ($view) {
                $classes = \Auth::user()->classes()->paginate(3, ['*'], 'more_classe');
                $view->with(compact('classes'));
            });
            View::composer('modals.dashbord.cours', function ($view) {
                $cours = \Auth::user()->cours()->paginate(3, ['*'], 'more_cours');
                $view->with(compact('cours'));
            });
            View::composer('modals.dashbord.planning', function ($view) {
                $isAllowToPlannificate = (empty(!\Auth::user()->cours->toArray()) && empty(!\Auth::user()->classes->toArray()));
                $occurrences = \Auth::user()->occurrences()->orderBy('id', 'desc')->paginate(10, ['*'], 'seances');
                $view->with(compact('isAllowToPlannificate', 'occurrences'));
            });
            View::composer('cours.index', function ($view) {
                $meta = \Auth::user()->metas()->lists('value', 'name');
                $cours = \Auth::user()->cours()->orderBy('name', 'asc')->paginate($meta['index_view_cours_nbr_pagination']);
                $isIndex=true;
                $view->with(compact('cours', 'meta','isIndex'));
            });
            View::composer('schools.index', function ($view) {
                $schools = \Auth::user()->schools()->paginate(4);
                $view->with(compact('schools'));
            });
            View::composer('cours.create', function ($view) {
                $meta = \Auth::user()->metas()->lists('value', 'name');
                $cours = \Auth::user()->cours()->orderBy('updated_at', 'desc')->paginate($meta['create_view_cours_nbr_pagination']);
                $isCreate=true;
                $view->with(compact('cours', 'meta','isCreate'));
            });
            View::composer('students.index', function ($view) {
                $meta = \Auth::user()->metas()->lists('value', 'name');
                $metaClasse = \Auth::user()->classes()->where('id', '=', $meta['index_view_student_classe_id'])->first();
                $students = \Auth::user()->students()->alphabetic()->paginate($meta['index_view_student_nbr_pagination']);
                if (null != $metaClasse) {
                    $students = $metaClasse->students()->orderBy('updated_at', 'desc')->paginate($meta['index_view_student_nbr_pagination']);
                }
                $classes = \Auth::user()->classes()->has('students')->lists('name', 'id');
                $classes['']='Toutes les classes';
                $isIndex=true;
                $view->with(compact('students', 'classes', 'meta','isIndex'));
            });
            View::composer('students.create', function ($view) {
                $meta = \Auth::user()->metas()->lists('value', 'name');
                $metaClasse = \Auth::user()->classes()->where('id', '=', $meta['create_view_student_classe_id'])->first();
                $students = \Auth::user()->students()->orderBy('updated_at', 'desc')->paginate($meta['create_view_student_nbr_pagination']);
                if (null != $metaClasse) {
                    $students = $metaClasse->students()->orderBy('updated_at', 'desc')->paginate($meta['create_view_student_nbr_pagination']);
                }
                $classes = \Auth::user()->classes()->has('students')->lists('name', 'id');
                $classes['']='Toutes les classes';
                $isCreate=true;
                $view->with(compact('students', 'classes', 'meta','isCreate'));
            });
            View::composer('students.edit', function ($view) {
                // see controller 
                $classes = \Auth::user()->classes()->has('students')->lists('name', 'id');
                $view->with(compact('classes'));
            });
            View::composer('classe.index', function ($view) {
                $meta = \Auth::user()->metas()->lists('value', 'name');
                $classes = \Auth::user()->classes()->orderBy('name', 'asc')->paginate($meta['index_view_classe_nbr_pagination']);
                $isIndex=true;
                $view->with(compact('classes', 'meta','isIndex'));
            });
            View::composer('classe.create', function ($view) {
                $meta = \Auth::user()->metas()->lists('value', 'name');
                $classes = \Auth::user()->classes()->orderBy('updated_at', 'desc')->paginate($meta['create_view_classe_nbr_pagination']);
                $isCreate=true;
                $view->with(compact('classes', 'meta','isCreate'));
            });
            View::composer('configuration.config', function ($view) {
                $user = \Auth::user();
                $colorTable = config('app.statutsColors');
                $allColor = $colorTable;
                $userStatuts = Auth::user()->statuts;
                foreach ($userStatuts as $satut) {
                    unset($colorTable[ $satut->color ]);
                }
                $view->with(['colorTable' => $colorTable, 'allColor' => $allColor, 'user' => $user]);
            });
            View::composer('forms.class.create', function ($view) {
                $schools = \Auth::user()->schools->lists('name', 'id');
                $students = \Auth::user()->students()->alphabetic()->get()->lists('fullname', 'id');

                $view->with(compact('schools', 'classes', 'students'));
            });
            View::composer('forms.class.edit', function ($view) {
                $schools = \Auth::user()->schools->lists('name', 'id');
                $students = \Auth::user()->students()->alphabetic()->get()->lists('fullname', 'id');
                $view->with(compact('schools', 'students'));
            });
            View::composer('forms.students.create', function ($view) {
                $classes = \Auth::user()->classes->lists('name', 'id');
                $schools = \Auth::user()->schools->lists('name', 'id');
                $view->with(compact('classes', 'schools'));
            });
            View::composer('forms.seances.create_full_seance', function ($view) {
                $classes = \Auth::user()->classes;
                $cours = \Auth::user()->cours->lists('name', 'id');
                $schools = \Auth::user()->schools->lists('name', 'id');
                $view->with(compact('classes', 'schools', 'cours'));
            });
            View::composer('forms.students.import', function ($view) {
                $allClasses = \Auth::user()->classes()->lists('name', 'id');
                $allClasses['']='Sans classe';
                $view->with(compact('allClasses'));
            });
            View::composer('students.validate-import', function ($view) {
                $allClasses = \Auth::user()->classes()->lists('name', 'id');
                $allClasses['']='N’appartient à aucune classe';
                $view->with(compact('allClasses'));
            });
            View::composer('seances.create_full_seance', function ($view) {
                $hasCours = empty(!\Auth::user()->cours->toArray());
                $hasClasses = empty(!\Auth::user()->classes->toArray());
                $isAllowToPlannificate = ($hasCours && $hasClasses);
                $view->with(compact('hasClasses', 'hasCours', 'isAllowToPlannificate'));
            });
            View::composer('seances.index', function ($view) {
                $occurrences = \Auth::user()->occurrences()->orderBy('id', 'desc')->paginate(6);
                $view->with(compact('occurrences'));
            });
            View::composer('errors.error_seances', function ($view) {
                $user = \Auth::user();
                $cours = $user->cours;
                $classes = $user->classes;
                $students = $user->students;
                $view->with(compact('students', 'cours', 'classes', 'user'));
            });
            View::composer('modals.config.present-status', function ($view) {
                $statuts = \Auth::user()->statuts()->oderByDefault()->get();
                $view->with(compact('statuts'));
            });
            View::composer('forms.statuts.update-default', function ($view) {
                $statuts = \Auth::user()->statuts()->oderByDefault()->get();
                $view->with(compact('statuts'));
            });
            View::composer('emails.user-verification', function ($view) {
                $user = \Auth::user();
                $view->with(compact('user'));
            });
        }

        /**
         * Register the application services.
         *
         * @return void
         */
        public function register()
        {

        }
    }