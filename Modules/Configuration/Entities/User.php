<?php

namespace Modules\Configuration\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Carbon\Carbon;

class User extends Model implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = "users";

    /**
     * The attributes that are mass assignable
     * 
     * @var array
     */
    protected $fillable = [
        'role_id',
        'full_name',
        'username', 
        'password',
        'is_active',
        'designation',
        'image_icon',
    ];

    /**
     * Hidden attributes which are excluded from the model's JSON form.
     * 
     * @var array
     */
    protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];
       
    /**
     * Get role of the user
     */
    public function role()
    {
        return $this->belongsTo('Modules\Configuration\Entities\Role', 'role_id');       
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d F Y'); 
    }
}
