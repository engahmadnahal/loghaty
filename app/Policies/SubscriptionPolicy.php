<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Subscription;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubscriptionPolicy
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
        return $user->hasPermissionTo('Read-subscrip') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view($user, Subscription $subscription)
    {
        return $user->hasPermissionTo('Read-subscrip') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create($user)
    {
        return $user->hasPermissionTo('Create-subscrip') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update($user, Subscription $subscription)
    {
        return $user->hasPermissionTo('Update-subscrip') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete($user, Subscription $subscription)
    {
        return $user->hasPermissionTo('Read-subscrip') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore($user, Subscription $subscription)
    {
        return $user->hasPermissionTo('Read-subscrip') ? $this->allow() : $this->deny();
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Admin  $admin
     * @param  \App\Models\Subscription  $subscription
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete($user, Subscription $subscription)
    {
        return $user->hasPermissionTo('Delete-subscrip') ? $this->allow() : $this->deny();
    }
}
