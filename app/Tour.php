<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
