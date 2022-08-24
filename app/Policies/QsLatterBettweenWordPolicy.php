<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\QsLatterBettweenWord;
use Illuminate\Auth\Access\HandlesAuthorization;

class QsLatterBettweenWordPolicy
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
     * @param  \App\Models\QsLatterBettweenWord  $qsLatterBettweenWord
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, QsLatterBettweenWord $qsLatterBettweenWord)
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
     * @param  \App\Models\QsLatterBettweenWord  $qsLatterBettweenWord
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, QsLatterBettweenWord $qsLatterBettweenWord)
    {
        return $user->hasPermissionTo('Update-qs') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\QsLatterBettweenWord  $qsLatterBettweenWord
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, QsLatterBettweenWord $qsLatterBettweenWord)
    {
        return $user->hasPermissionTo('Delete-qs') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\QsLatterBettweenWord  $qsLatterBettweenWord
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, QsLatterBettweenWord $qsLatterBettweenWord)
    {
        return $user->hasPermissionTo('Delete-qs') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\QsLatterBettweenWord  $qsLatterBettweenWord
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, QsLatterBettweenWord $qsLatterBettweenWord)
    {
        return $user->hasPermissionTo('Delete-qs') ? $this->allow() : $this->deny();
    }
}
