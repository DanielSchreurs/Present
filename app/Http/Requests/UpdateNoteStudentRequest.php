<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateNoteStudentRequest extends Request
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
            'note'       => 'required|string|min:2',
            'type'       => 'required|in:'.implode(',',array_keys(config('app.noteTypes')))
        ];
    }
}
