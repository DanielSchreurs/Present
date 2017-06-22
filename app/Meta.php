<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Meta
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Meta whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Meta extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meta';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'value'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
