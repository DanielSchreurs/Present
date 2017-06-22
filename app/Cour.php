<?php

    namespace App;

    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Model;
    use Cviebrock\EloquentSluggable\SluggableInterface;
    use Cviebrock\EloquentSluggable\SluggableTrait;

    /**
 * App\Cour
 *
 * @property integer                                                     $id
 * @property string                                                      $name
 * @property string                                                      $slug
 * @property integer                                                     $user_id
 * @property \Carbon\Carbon                                              $created_at
 * @property \Carbon\Carbon                                              $updated_at
 * @property-read \App\User                                              $user
 * @method static \Illuminate\Database\Query\Builder|\App\Cour whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cour whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cour whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cour whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cour whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Cour whereUpdatedAt($value)
 * @property-read mixed                                                  $has_occurrence
 * @property-read mixed                                                  $get_occurrence
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Classe[] $classes
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Occurrence[] $occurrences
 * @method static \Illuminate\Database\Query\Builder|\App\Cour whereDescription($value)
 * @mixin \Eloquent
 * @property-read mixed $is_updated_now
 */
    class Cour extends Model implements SluggableInterface
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
        protected $table = 'cours';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['name','description', 'slug', 'user_id'];

        public function getHasOccurrenceAttribute()
        {
            return !is_null(Occurrence::all()->where('cour_id', $this->id)->first());
        }

        public function getIsUpdatedNowAttribute()
        {
            return $this->updated_at->between(Carbon::now()->subSeconds(2),Carbon::now()->addSeconds(2),false);
        }

        public function getGetOccurrenceAttribute()
        {
            return Occurrence::all()->where('cour_id', $this->id)->first();
        }

        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function user()
        {
            return $this->belongsTo('App\User');
        }

        public function classes()
        {
            return $this->belongsToMany('App\Classe');
        }

        public function occurrences()
        {
            return $this->hasMany('App\Occurrence');
        }

    }
