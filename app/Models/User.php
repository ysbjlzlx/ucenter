<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class User.
 *
 * @property string username 用户名
 * @property string password 密码
 */
class User extends \Illuminate\Foundation\Auth\User
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
        'password',
        'updated_at',
        'created_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function getEmailAttribute($value)
    {
        $arr = explode('@', $value, 2);

        return Str::limit($arr[0], 3, '***@'.$arr[1]);
    }

    public function getAvatarAttribute($value)
    {
        return empty($value) ? $value : Storage::url($value);
    }

    public function tokens()
    {
        return $this->hasMany(Token::class, 'user_id');
    }
}
