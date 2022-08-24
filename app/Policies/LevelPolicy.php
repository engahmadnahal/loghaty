<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Level;
use Illuminate\Auth\Access\HandlesAuthorization;

class LevelPolicy
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
        return $user->hasPermissionTo('Read-level') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Level $level)
    {
        return $user->hasPermissionTo('Read-level') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-level') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Level $level)
    {
        return $user->hasPermissionTo('Update-level') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Level $level)
    {
        return $user->hasPermissionTo('Delete-level') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Level $level)
    {
        return $user->hasPermissionTo('Delete-level') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Level $level)
    {
        return $user->hasPermissionTo('Delete-level') ? $this->allow() : $this->deny();
    }
}
