<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProjectSite extends Model
{

    protected $fillable = [
        'name', 'description'
    ];

    public function areaManagers()
    {
        return $this->belongsToMany('App\User', 'user_has_project_sites', 'project_site_id', 'user_id')->withTimestamps();
    }

    public function getTheDescriptionAttribute()
    {
        return Str::limit($this->description, '30', '...');
    }

    public function registrants()
    {
        return $this->belongsToMany('App\Registrant');
    }

}
