<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function projectManagers()
    {
        return $this->belongsToMany('App\ProjectManager', 'user_has_project_managers', 'user_id', 'project_manager_user_id')->withTimestamps();
    }

    public function projectSites()
    {
        return $this->belongsToMany('App\ProjectSite', 'user_has_project_sites', 'user_id', 'project_site_id')->withTimestamps();
    }

    public function registrant()
    {
        return $this->belongsTo('App\Registrant', 'user_has_area_managers', 'user_id', 'area_manager_id')->withTimestamps();
    }

}
