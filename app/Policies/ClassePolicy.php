<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Classe;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClassePolicy
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
        return $user->hasPermissionTo('Read-class') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Classe  $class
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Classe $class)
    {
        return $user->hasPermissionTo('Read-class') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-class') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Classe  $class
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Classe $class)
    {
        dd(1);
        return $user->hasPermissionTo('Update-class') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Classe  $class
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Classe $class)
    {
        return $user->hasPermissionTo('Delete-class') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Classe  $class
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Classe $class)
    {
        return $user->hasPermissionTo('Delete-class') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Classe  $class
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Classe $class)
    {
        return $user->hasPermissionTo('Delete-class') ? $this->allow() : $this->deny();
    }
}
