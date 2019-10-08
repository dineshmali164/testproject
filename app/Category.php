<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function Type()
    {
        return $this->hasMany('App\Type');
    }
}