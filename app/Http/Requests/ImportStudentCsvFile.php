<?php

    namespace App\Http\Requests;

    use App\Http\Requests\Request;

    class ImportStudentCsvFile extends Request
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
            $id= \Auth::user()->id;
            return [
                'student_list' => 'required',
                'classe_id'    => 'integer|exists:classes,id,user_id,' . $id
            ];
        }
    }
