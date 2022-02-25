<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LicenseController extends Controller
{
    public function getIp(Request $request)
    {
        // dd($_SERVER);
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];

        /**
         * TO-DO CHECK IP IN DATABASE
         */

        return response($ip, 404);
    }
}
