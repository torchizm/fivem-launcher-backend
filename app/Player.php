<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $guarded = ['id'];

    public function banPath()
    {
        return "/dashboard/player/{$this->id}";
    }

    public function editPath()
    {
        return "/dashboard/player/{$this->id}";
    }

    public function deletePath()
    {
        return "/dashboard/user/{$this->id}";
    }

    public function bans()
    {
        return $this->hasMany('App\Ban', 'uid', 'uid')->get();
    }
}
