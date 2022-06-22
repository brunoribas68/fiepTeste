<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $rss
 * @property string $created_at
 * @property string $updated_at
 */
class Rss extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'rss';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'rss', 'created_at', 'updated_at'];

    public function user_id()
    {
        return $this->hasOne(User::class);
    }
}
