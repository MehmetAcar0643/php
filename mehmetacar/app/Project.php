<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable=['title','slug','description','file','baslangic','bitis'];
    public function studies()
    {
        return $this->belongsTo('App\Study')->withDefault();
    }

    public function projectImages()
    {
        return $this->hasMany('App\ProjectImage')->orderBy('must');
    }

}
