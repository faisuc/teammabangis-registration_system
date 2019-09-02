<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectManager extends Model
{

    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function areaManagers()
    {
        return $this->belongsToMany('App\User', 'user_has_project_managers', 'project_manager_user_id', 'user_id')->withTimestamps();
    }

}
