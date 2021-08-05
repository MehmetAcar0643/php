<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $table = "project_images";

    public function project()
    {
        return $this->belongsTo('App\Project')->withDefault();
    }
}
