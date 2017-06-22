<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;

    /**
 * App\Present
 *
 * @property integer        $id
 * @property integer        $student_id
 * @property integer        $occurrence_id
 * @property boolean        $is_present
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereStudentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereOccurrenceId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereIsPresent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereUpdatedAt($value)
 * @property-read \App\Occurrence $occurrence
 * @property integer $statut_id
 * @property-read \App\Statut $statut
 * @property-read \App\Student $student
 * @method static \Illuminate\Database\Query\Builder|\App\Present whereStatutId($value)
 * @mixin \Eloquent
 */
    class Present extends Model
    {
        protected $table = 'presents';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['student_id', 'user_id', 'occurrence_id', 'statut_id'];

        public function occurrence()
        {
            return $this->belongsTo('App\Occurrence');
        }
        public function statut()
        {
            return $this->belongsTo('App\Statut');
        }
        public function student()
        {
            return $this->belongsTo('App\Student');
        }
    }
