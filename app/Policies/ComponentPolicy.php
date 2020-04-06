<?php

namespace App\Policies;

use App\Component;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ComponentPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->role === "admin") {
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Component  $component
     * @return mixed
     */
    public function update(User $user, Component $component)
    {
        return $user->id == $component->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Component  $component
     * @return mixed
     */
    public function delete(User $user, Component $component)
    {
        return $user->id == $component->user_id;
    }

    public function preview(?User $user, Component $component)
    {
        if (is_null($component->approved_at)) {
            return false;
        }

        return true;
    }
}
