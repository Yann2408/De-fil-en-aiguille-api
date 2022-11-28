<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
   public function test()
   {
     $hello = "hello world";

     return response()->json($hello, 200);
   }
}
