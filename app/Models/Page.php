<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    const IS_LANDING_PAGE = 1;

    public function roles(){
        return $this->belongsToMany(Role::class, 'role_pages');
    }
}
