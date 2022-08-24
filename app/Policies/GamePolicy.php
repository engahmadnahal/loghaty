<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Game;
use Illuminate\Auth\Access\HandlesAuthorization;

class GamePolicy
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
        return $user->hasPermissionTo('Read-game') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Game $game)
    {
        return $user->hasPermissionTo('Read-game') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-game') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Game $game)
    {
        return $user->hasPermissionTo('Update-game') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Game $game)
    {
        return $user->hasPermissionTo('Delete-game') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Game $game)
    {
        return $user->hasPermissionTo('Delete-game') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Game $game)
    {
        return $user->hasPermissionTo('Delete-game') ? $this->allow() : $this->deny();
    }
}
