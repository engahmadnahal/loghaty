<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Children;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChildrenPolicy
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
        return $user->hasPermissionTo('Read-children') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Children $children)
    {
        return $user->hasPermissionTo('Read-children') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-children') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Children $children)
    {
        return $user->hasPermissionTo('Update-children') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Children $children)
    {
        return $user->hasPermissionTo('Delete-children') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Children $children)
    {
        return $user->hasPermissionTo('Delete-children') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Children $children)
    {
        return $user->hasPermissionTo('Delete-children') ? $this->allow() : $this->deny();
    }
}
