<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\QsOrderLatter;
use Illuminate\Auth\Access\HandlesAuthorization;

class QsOrderLatterPolicy
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
        return $user->hasPermissionTo('Read-qs') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\QsOrderLatter  $qsOrderLatter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, QsOrderLatter $qsOrderLatter)
    {
        return $user->hasPermissionTo('Read-qs') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-qs') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\QsOrderLatter  $qsOrderLatter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, QsOrderLatter $qsOrderLatter)
    {
        return $user->hasPermissionTo('Update-qs') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\QsOrderLatter  $qsOrderLatter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, QsOrderLatter $qsOrderLatter)
    {
        return $user->hasPermissionTo('Delete-qs') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\QsOrderLatter  $qsOrderLatter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, QsOrderLatter $qsOrderLatter)
    {
        return $user->hasPermissionTo('Delete-qs') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\QsOrderLatter  $qsOrderLatter
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, QsOrderLatter $qsOrderLatter)
    {
        return $user->hasPermissionTo('Delete-qs') ? $this->allow() : $this->deny();
    }
}
