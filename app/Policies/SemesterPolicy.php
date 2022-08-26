<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Semester;
use Illuminate\Auth\Access\HandlesAuthorization;

class SemesterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny($user)
    {

        //
        return $user->hasPermissionTo('Read-semester') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Semester $semester)
    {
        //
        return $user->hasPermissionTo('Read-semester') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-semester') ? $this->allow() : $this->deny();
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Semester $semester)
    {
        return $user->hasPermissionTo('Update-semester') ? $this->allow() : $this->deny();
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Semester $semester)
    {
        return $user->hasPermissionTo('Delete-semester') ? $this->allow() : $this->deny();
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Semester $semester)
    {
        return $user->hasPermissionTo('Delete-semester') ? $this->allow() : $this->deny();
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Semester  $semester
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Semester $semester)
    {
        return $user->hasPermissionTo('Delete-semester') ? $this->allow() : $this->deny();
        //
    }
}
