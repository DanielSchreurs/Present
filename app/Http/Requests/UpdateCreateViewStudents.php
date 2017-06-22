<?php

    namespace App\Http\Requests;

    use App\Http\Requests\Request;
    use Illuminate\Support\Facades\Auth;

    class UpdateCreateViewStudents extends Request
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            $id = \Auth::user()->id;
            return [
                'create_view_student_list_block'     => 'boolean',
                'create_view_classe_list_block'      => 'boolean',
                'create_view_cours_list_block'       => 'boolean',
                'create_view_student_nbr_pagination' => 'integer|min:'.min(config('app.defaultCreatePaginationStudent')).'|max:'.max(config('app.defaultCreatePaginationStudent')),
                'create_view_classe_nbr_pagination'  => 'integer|min:'.min(config('app.defaultCreatePaginationClasse')).'|max:'.max(config('app.defaultCreatePaginationClasse')),
                'create_view_cours_nbr_pagination'   => 'integer|min:'.min(config('app.defaultCreatePaginationCours')).'|max:'.max(config('app.defaultCreatePaginationCours')),
                'create_view_student_classe_id'      => 'integer|exists:classes,id,user_id,' . $id
            ];
        }
    }
