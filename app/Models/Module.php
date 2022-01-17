<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $guarded = [];

    public function subModules(){
        return $this->hasMany(SubModule::class);
    }
}
