<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ban extends Model
{
    protected $guarded = ['id'];

    protected $dates = ['until'];
}
