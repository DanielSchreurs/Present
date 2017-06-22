<?php

    namespace App\Http\Requests;

    use App\Http\Requests\Request;

    class StoreStudentRequest extends Request
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
            return [
                'first_name' => 'required|string|max:250|min:2',
                'last_name'  => 'required|string|max:250|min:2',
                'email'      => 'required|e-mail|unique:students',
                'avatar'     => 'mimes:jpeg,png|image_size:100-10000'
            ];
        }
    }
