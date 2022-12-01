<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function home()
    {
        $hello = "hello world";

     return response()->json($hello, 200);
    }

}
