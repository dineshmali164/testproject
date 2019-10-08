<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function typecat()
    {
        return $this->belongsTo('App\Category','category');
    }

    public function typesubcat()
    {
        return $this->belongsTo('App\SubCategory','subcategory');
    }

    public function typesubsubcat()
    {
        return $this->belongsTo('App\subsubcategory','subsubcategory');
    }
}
