<?php

    namespace App\Http\Requests;

    use App\Http\Requests\Request;

    class UpdateUserProfilRequest extends Request
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
            $id=\Auth::user()->id;
            return [
                'name'   => 'required|string|max:250|min:2',
                'email'  => 'required|e-mail|unique:users,email,'.$id,
                'avatar' => 'mimes:jpeg,png|image_size:100-10000'
            ];
        }
    }
