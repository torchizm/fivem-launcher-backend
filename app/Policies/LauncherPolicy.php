<?php

namespace App\Policies;

use App\User;
use App\Launcher;
use Illuminate\Auth\Access\HandlesAuthorization;

class LauncherPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Launcher $launcher)
    {
        if ($user->id === $launcher->user_id || $user->power > 3) {
            return true;
        }

        return false;
    }
}
