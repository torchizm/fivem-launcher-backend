<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $guarded = ['id'];

    public function path()
    {
        return "/dashboard/server/{$this->slug}";
    }

    public function adminPath()
    {
        return "/dashboard/admin/server/{$this->slug}";
    }

    public function launcher()
    {
        return $this->hasOne('App\Launcher', 'token', 'launcher_token')->first();
    }

    public function owner()
    {
        return $this->hasOne('App\User', 'id', 'user_id')->first();
    }

    public function players()
    {
        return $this->hasMany('App\Player', 'launcher_token', 'launcher_token')->get();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
