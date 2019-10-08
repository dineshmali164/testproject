<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subsubcategory extends Model
{
    public function Type()
    {
        return $this->hasmany('App\Type');
    }
}
