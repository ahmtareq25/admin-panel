<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }

    public function Pages(){
        return $this->belongsToMany(Page::class, 'role_pages');
    }

    public function getAllRole(){
        return self::all();
    }

    public function findById($id){
        return self::find($id);
    }

    public function deleteById($id){
        return self::destroy($id);
    }
}
