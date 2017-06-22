<?php

    namespace App\Http\Controllers\Www;

    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\View\View;

    class SearchController extends Controller
    {
        /**
         * ClassController constructor.
         */
        public function __construct()
        {
            $this->middleware('auth');
            $this->resultats = [];
        }

        public function mainSearch(Request $request)
        {

            $query = $request->search;
            if (!empty($query)) {
                $students = Auth::user()->students()
                    ->where('first_name', 'LIKE', '%' . $query . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $query . '%')
                    ->orWhere(\DB::raw('concat(first_name," ",last_name)'), 'LIKE', '%' . $query . '%')
                    ->orWhere('email', 'LIKE', '%' . $query . '%')
                    ->orWhere('slug', 'LIKE', '%' . $query . '%')->paginate(4, ['*'], 'more_students');
                $cours = Auth::user()->cours()
                    ->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('description', 'LIKE', '%' . $query . '%')
                    ->orWhere('slug', 'LIKE', '%' . $query . '%')->paginate(4, ['*'], 'more_cours');
                $classes = Auth::user()->classes()
                    ->where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('slug', 'LIKE', '%' . $query . '%')->paginate(4, ['*'], 'more_classes');
                if ((!$students->count()) && (!$cours->count()) && (!$classes->count())) {
                    \Flash::error('Oups, nous n’avons pas trouvé de résultats pour la recherche : ' . $query);
                } else {
                    return \View::make('search.results')->with(['students' => $students, 'cours' => $cours, 'classes' => $classes, 'query' => $query]);
                }

            } else {
                \Flash::error('Oups, vous avez oublié d’introduire votre recherche');
            }

            return \Redirect::back();
        }

        public function notFoundSearch()
        {
            return view('search.not_found');
        }

        public function noQuerySearch()
        {
            return view('search.no_query');
        }

    }
