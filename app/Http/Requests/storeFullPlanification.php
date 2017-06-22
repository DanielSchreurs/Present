<?php

    namespace App\Http\Requests;

    use App\Http\Requests\Request;
    use Carbon\Carbon;

    class storeFullPlanification extends Request
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
            $fromDate = (new Carbon())->yesterday()->toDateString();
            $endDate = (new Carbon($this->from))->addWeeks(1)->toDateString();
            $maxEndDate = (new Carbon())->addYears(1)->toDateString();
            return [
                'school_id' => 'numeric',
                'classe_id' => 'required|numeric',
                'cour_id'   => 'required|numeric',
                'from'      => 'required|date|after:' . $fromDate . '|date|before:' . $maxEndDate,
                'to'        => 'required|date|after:' . $endDate . '|date|before:' . $maxEndDate,
                'day'       => 'required|integer|between:0,6',
                'from_hour' => ['required', 'Regex:/^(([0-1][0-9])|(2[0-3])):[0-5][0-9]$/'],
                'to_hour'   => ['required', 'Regex:/^(([0-1][0-9])|(2[0-3])):[0-5][0-9]$/', 'after:from_hour']
            ];
        }
    }
