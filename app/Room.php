<?php

    namespace App;

    use Illuminate\Database\Eloquent\Model;
    use Cviebrock\EloquentSluggable\SluggableInterface;
    use Cviebrock\EloquentSluggable\SluggableTrait;

    /**
 * App\Room
 *
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property integer $school_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\School $school
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereSchoolId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Room whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Room extends Model implements SluggableInterface
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
        protected $table = 'rooms';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['name', 'slug', 'school_id'];

        public function school()
        {
            return $this->belongsTo('App\School');
        }
    }
