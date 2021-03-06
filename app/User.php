<?php

namespace App;

use App\Models\Role;
use App\Models\Work;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;

class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    protected $dates = [
        'activation_request_date'
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
    protected $fillable = [
        'name',
        'email',
        'password',
        'photo',
        'uid',
        'network',
        'identity',
        'activation_token'
    ];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function setRolesAttribute($roles)
    {
        $this->roles()->detach();
        if ( ! $roles) return;
        if ( ! $this->exists) $this->save();

        $this->roles()->attach($roles);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    public function comments()
    {
        return $this->hasMany(Work::class);
    }
}
