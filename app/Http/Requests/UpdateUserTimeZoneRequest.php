<?php

    namespace App\Http\Requests;

    use App\Http\Requests\Request;
    use Carbon\Carbon;

    class UpdateUserTimeZoneRequest extends Request
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
            $endDate = (new Carbon($this->defaultSchoolYearBegin))->addWeeks(1)->toDateString();
            $maxEndDate = (new Carbon())->addYears(1)->toDateString();
            return [
                'defaultSchoolYearBegin' => 'required|date|after:' . $fromDate . '|date|before:' . $maxEndDate,
                'defaultSchoolYearEnd'   => 'required|date|after:' . $endDate . '|date|before:' . $maxEndDate,
                'defaultCoursDuration'   => 'required|numeric|min:10',
                'defaultDayBegin'        => ['required', 'Regex:/^(([0-1][0-9])|(2[0-3])):[0-5][0-9]$/'],
                'defaultDayEnd'          => ['required', 'Regex:/^(([0-1][0-9])|(2[0-3])):[0-5][0-9]$/','after:defaultDayBegin'],
            ];
        }
    }
