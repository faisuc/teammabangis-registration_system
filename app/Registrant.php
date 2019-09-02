<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Registrant extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    protected $guard_name = 'web';
    protected $table = 'users';

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

    public function projectSites()
    {
        return $this->belongsToMany('App\ProjectSite', 'registrant_has_project_sites', 'user_id', 'project_site_id')->withTimestamps();
    }

    public function areaManagers()
    {
        return $this->belongsToMany('App\User', 'registrant_has_area_managers', 'user_id', 'area_manager_id')->withTimestamps();
    }

    public function personalInformation()
    {
        return $this->hasOne('App\PersonalInformation', 'user_id', 'id');
    }

    public function spouseInformation()
    {
        return $this->hasOne('App\SpouseInformation', 'user_id', 'id');
    }

    public function contactPersonInCaseOfEmergency()
    {
        return $this->hasOne('App\ContactPersonInCaseOfEmergency', 'user_id', 'id');
    }

}
