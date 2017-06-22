<?php

    namespace App;

    use Illuminate\Auth\Authenticatable;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Auth\Passwords\CanResetPassword;
    use Illuminate\Foundation\Auth\Access\Authorizable;
    use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
    use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
    use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
    use Cviebrock\EloquentSluggable\SluggableInterface;
    use Cviebrock\EloquentSluggable\SluggableTrait;

    /**
 * App\User
 *
 * @property integer                                                         $id
 * @property string                                                          $first_name
 * @property string                                                          $last_name
 * @property string                                                          $slug
 * @property string                                                          $email
 * @property string                                                          $password
 * @property string                                                          $remember_token
 * @property \Carbon\Carbon                                                  $created_at
 * @property \Carbon\Carbon                                                  $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\School[]     $schools
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Cour[]       $cours
 * @method static \Illuminate\Database\Query\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereUpdatedAt($value)
 * @property-read mixed                                                      $fullname
 * @property-read mixed                                                      $has_occurrence
 * @property-read mixed                                                      $get_all_occurrence
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Student[]    $students
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Classe[]     $classes
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Occurrence[] $occurrences
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Note[]       $notes
 * @property string                                                          $avatar
 * @method static \Illuminate\Database\Query\Builder|\App\User whereAvatar($value)
 * @property string $name
 * @property string $defaultSchoolYearBegin
 * @property string $defaultSchoolYearEnd
 * @property integer $defaultCoursDuration
 * @property string $defaultDayBegin
 * @property string $defaultDayEnd
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Statut[] $statuts
 * @property boolean $verified
 * @property string $verification_token
 * @method static \Illuminate\Database\Query\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDefaultSchoolYearBegin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDefaultSchoolYearEnd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDefaultCoursDuration($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDefaultDayBegin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereDefaultDayEnd($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereVerified($value)
 * @method static \Illuminate\Database\Query\Builder|\App\User whereVerificationToken($value)
 * @mixin \Eloquent
 */
    class User extends Model implements AuthenticatableContract,
                                        AuthorizableContract,
                                        CanResetPasswordContract,
                                        SluggableInterface
    {
        use Authenticatable, Authorizable, CanResetPassword, SluggableTrait;

        protected $sluggable = [
            'build_from' => 'name',
            'save_to'    => 'slug',
        ];

        /**
         * The database table used by the model.
         *
         * @var string
         */
        protected $table = 'users';

        /**
         * The attributes that are mass assignable.
         *
         * @var array
         */
        protected $fillable = ['name', 'slug', 'email', 'password', 'school_id', 'avatar', 'defaultSchoolYearBegin', 'defaultSchoolYearEnd', 'defaultCoursDuration', 'defaultDayBegin', 'defaultDayEnd','verified','verification_token'];
        protected $hidden = ['password', 'remember_token'];

        public function getHasOccurrenceAttribute()
        {
            return !is_null(Occurrence::all()->where('user_id', $this->id)->first());
        }
        /**
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        public function schools()
        {
            return $this->hasMany('App\School');
        }

        public function cours()
        {
            return $this->hasMany('App\Cour');
        }

        public function students()
        {
            return $this->hasMany('App\Student');
        }

        public function classes()
        {
            return $this->hasMany('App\Classe');
        }

        public function occurrences()
        {
            return $this->hasMany('App\Occurrence');
        }

        public function notes()
        {
            return $this->hasMany('App\Note');
        }

        public function metas()
        {
            return $this->hasMany('App\Meta');
        }

        public function statuts()
        {
            return $this->hasMany('App\Statut');
        }

    }
