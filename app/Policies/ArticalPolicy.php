<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Artical;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticalPolicy
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
        return $user->hasPermissionTo('Read-artical') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Artical $artical)
    {
        return $user->hasPermissionTo('Read-artical') ? $this->allow() : $this->deny();
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-artical') ? $this->allow() : $this->deny();
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Artical $artical)
    {
        return $user->hasPermissionTo('Update-artical') ? $this->allow() : $this->deny();
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Artical $artical)
    {
        return $user->hasPermissionTo('Delete-artical') ? $this->allow() : $this->deny();
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Artical $artical)
    {
        return $user->hasPermissionTo('Delete-artical') ? $this->allow() : $this->deny();
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Artical  $artical
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Artical $artical)
    {
        return $user->hasPermissionTo('Delete-artical') ? $this->allow() : $this->deny();
        //
    }
}
