<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Father;
use Illuminate\Auth\Access\HandlesAuthorization;

class FatherPolicy
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
        return $user->hasPermissionTo('Read-father') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Father  $father
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Father $father)
    {
        return $user->hasPermissionTo('Read-father') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-father') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Father  $father
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Father $father)
    {
        return $user->hasPermissionTo('Update-father') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Father  $father
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Father $father)
    {
        return $user->hasPermissionTo('Delete-father') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Father  $father
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Father $father)
    {
        return $user->hasPermissionTo('Delete-father') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Father  $father
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Father $father)
    {
        return $user->hasPermissionTo('Delete-father') ? $this->allow() : $this->deny();
    }
}
