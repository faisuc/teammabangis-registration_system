<?php

namespace App\Policies;

use App\User;
use App\ProjectSite;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectSitePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any project sites.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the project site.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectSite  $projectSite
     * @return mixed
     */
    public function view(User $user, ProjectSite $projectSite)
    {
        return $user->hasRole('super-admin|admin');
    }

    /**
     * Determine whether the user can create project sites.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the project site.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectSite  $projectSite
     * @return mixed
     */
    public function update(User $user, ProjectSite $projectSite)
    {
        //
    }

    /**
     * Determine whether the user can delete the project site.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectSite  $projectSite
     * @return mixed
     */
    public function delete(User $user, ProjectSite $projectSite)
    {
        //
    }

    /**
     * Determine whether the user can restore the project site.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectSite  $projectSite
     * @return mixed
     */
    public function restore(User $user, ProjectSite $projectSite)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the project site.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectSite  $projectSite
     * @return mixed
     */
    public function forceDelete(User $user, ProjectSite $projectSite)
    {
        //
    }
}
