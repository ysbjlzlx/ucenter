<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Token.
 *
 * @property int user_id 用户 ID
 * @property string access_token access_token
 */
class Token extends Model
{
    use SoftDeletes;
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
