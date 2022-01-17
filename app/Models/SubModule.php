<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubModule extends Model
{
    protected $guarded = [];

    public function module(){
        return $this->hasOne(Module::class);
    }

    public function pages(){
        return $this->hasMany(Page::class);
    }
}
