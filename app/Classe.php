<?php

    namespace App;

    use App\Student;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Model;
    use Cviebrock\EloquentSluggable\SluggableInterface;
    use Cviebrock\EloquentSluggable\SluggableTrait;

    /**
 * App\Classe
 *
 * @property integer                                                         $id
 * @property string                                                          $name
 * @property string                                                          $slug
 * @property integer                                                         $user_id
 * @property \Carbon\Carbon                                                  $created_at
 * @property \Carbon\Carbon                                                  $updated_at
 * @property-read \App\User                                                  $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Student[]    $students
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Occurrence[] $occurrences
 * @method static \Illuminate\Database\Query\Builder|\App\Classe whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Classe whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Classe whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Classe whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Classe whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Classe whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Cour[]       $cours
 * @method static \Illuminate\Database\Query\Builder|\App\Classe hasStudents()
 * @mixin \Eloquent
 * @property-read mixed $is_updated_now
 */
    class Classe extends Model implements SluggableInterface
    {
        use SluggableTrait;

        protected $sluggable = [
            'build_from' => 'name',
            'save_to'    => 'slug',
        ];

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'classes';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['name', 'slug', 'user_id','created_at','updated_at'];

        public function user()
        {
            return $this->belongsTo('App\User');
        }

        public function scopeHasStudents($query)
        {
            return true;
        }

        public function getIsUpdatedNowAttribute()
        {
            return $this->updated_at->between(Carbon::now()->subSeconds(2), Carbon::now()->addSeconds(2), false);
        }

        public function students()
        {
            return $this->belongsToMany('App\Student');
        }

        public function cours()
        {
            return $this->belongsToMany('App\Cour');
        }

        public function occurrences()
        {
            return $this->hasMany('App\Occurrence');
        }
    }
