<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GeoLocationController extends Controller
{
    public function index(Request $request)
    {
            //$ip = $request->ip();
    		$ip = '2601:601:9d00:6e20:2014:24ca:2848:7ceb';
            $location = \Location::get($ip);
            dd($data);
    }
}