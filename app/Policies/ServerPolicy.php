<?php

namespace App\Policies;

use App\User;
use App\Server;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServerPolicy
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

    public function update(User $user, Server $server)
    {
        if ($user->id === $server->user_id || $user->power > 3) {
            return true;
        }

        return false;
    }
}
