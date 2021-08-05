<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    public function projects()
    {
        return $this->hasMany('App\Project')->orderBy('must');
    }

}
