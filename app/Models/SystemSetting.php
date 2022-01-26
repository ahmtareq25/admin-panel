<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $guarded = [];
    public $timestamps = false;


    public function findById($id){
        return $this->find($id);
    }
}
