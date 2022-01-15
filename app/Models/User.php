<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','id', 'phone_number', 'parent_user_id', 'permission_version'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    public function userRoles(){
        return $this->hasMany(UserRole::class);
    }

    public function findUserById($id){
        return User::find($id);
    }

    public function findUserByEmail($email){
        return User::query()->where('email', $email)->first();
    }

    public function findUserByPhone($phone){
        return User::query()->where('phone_number', $phone)->first();
    }

    public function deleteById($id){
        User::destroy($id);
    }

}
