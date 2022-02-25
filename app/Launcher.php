<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Launcher extends Model
{
    protected $guarded = ['id'];

    public function path()
    {
        return "/dashboard/admin/launcher/{$this->id}";
    }

    public function server()
    {
        return $this->hasOne('App\Server', 'launcher_token', 'token')->first();
    }

    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'user_id')->first();
    }
}
