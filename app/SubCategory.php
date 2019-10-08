<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public function Type()
    {
        return $this->hasMany('App\Type');
    }
}
