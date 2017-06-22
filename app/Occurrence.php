<?php

    namespace App;

    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Model;

    /**
 * App\Occurrence
 *
 * @property integer                                                      $id
 * @property \Carbon\Carbon                                               $day
 * @property \Carbon\Carbon                                               $from
 * @property \Carbon\Carbon                                               $to
 * @property integer                                                      $cour_id
 * @property integer                                                      $classe_id
 * @property integer                                                      $school_id
 * @property integer                                                      $user_id
 * @property \Carbon\Carbon                                               $created_at
 * @property \Carbon\Carbon                                               $updated_at
 * @property-read \App\School                                             $schools
 * @property-read \App\Classe                                             $classes
 * @property-read \App\User                                               $user
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence whereDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence whereFrom($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence whereTo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence whereCourId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence whereClasseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence whereUpdatedAt($value)
 * @property \Carbon\Carbon                                               $from_hour
 * @property \Carbon\Carbon                                               $to_hour
 * @property boolean                                                      $is_closed
 * @property-read \App\Occurrence                                         $Occurrence
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Present[] $presents
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence whereFromHour($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence whereToHour($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence whereIsClosed($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence today()
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence isClosed()
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence isOpen()
 * @property-read \App\Classe                                             $classe
 * @property-read \App\Cour                                               $cour
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence afterToday()
 * @method static \Illuminate\Database\Query\Builder|\App\Occurrence fromToday()
 * @mixin \Eloquent
 */
    class Occurrence extends Model
    {
        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'occurrences';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['cour_id', 'school_id', 'classe_id', 'from', 'to', 'day', 'from_hour', 'to_hour'];
        protected $dates = ['from', 'to', 'from_hour', 'to_hour'];

        public function setFromHourAttribute($value)
        {
            $time = explode(':', $value);
            $from_hour = new Carbon($this->attributes['from']);
            $from_hour->hour = $time[0];
            $from_hour->minute = $time[1];;
            $this->attributes['from_hour'] = $from_hour;
        }

        public function setToHourAttribute($value)
        {
            $time = explode(':', $value);
            $to_hour = new Carbon($this->attributes['from']);
            $to_hour->hour = $time[0];
            $to_hour->minute = $time[1];
            $this->attributes['to_hour'] = $to_hour;
        }

        public function scopeToday($query)
        {
            return $query->where('from', '=', Carbon::today());
        }
        public function scopeAfterToday($query)
        {
            return $query->where('from', '>=', Carbon::today());
        }

        public function scopeIsClosed($query)
        {
            return $query->where('is_closed', '=', 0);
        }

        public function scopeIsOpen($query)
        {
            return $query->where('is_closed', '=', 1);
        }

        public function scopeFromToday($query)
        {
            return $query->where('is_closed', '!=', 1)
                ->orderBy('from')
                ->afterToday();
        }

        public function schools()
        {
            return $this->belongsTo('App\School');
        }

        public function classe()
        {
            return $this->belongsTo('App\Classe');
        }

        public function cour()
        {
            return $this->belongsTo('App\Cour');
        }

        public function user()
        {
            return $this->belongsTo('App\User');
        }

       /* public function Occurrence()
        {
            return $this->belongsTo('App\Occurrence');
        }*/

        public function presents()
        {
            return $this->hasMany('App\Present');
        }

    }
