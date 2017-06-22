<?php

    namespace App\Http\Requests;

    use App\Http\Requests\Request;
    use App\Student;

    class UpdateStudentRequest extends Request
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
            $id = Student::findBySlugOrIdOrFail($this->route('student'))->id;

            return [
                'first_name' => 'required|string|max:250|min:2',
                'last_name'  => 'required|string|max:250|min:2',
                'email'      => 'required|e-mail|unique:students,email,' . $id,
                'avatar'     => 'mimes:jpeg,png|image_size:100-10000'
            ];
        }
    }
