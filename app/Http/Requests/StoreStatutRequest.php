<?php

    namespace App\Http\Requests;

    use App\Http\Requests\Request;
    use Illuminate\Support\Facades\Auth;

    class StoreStatutRequest extends Request
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
            $id = Auth::user()->id;

            return [
                'name'  => 'required|string|max:250|min:2|unique:statuts,name,NULL,id,user_id,'.$id,
                'color' => ['required', 'Regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})/', 'unique:statuts,color,NULL,id,user_id,'.$id],
            ];
        }
    }
