<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tissu;

class TissuController extends Controller
{

    public function getTissus()
    {
        $tissus = Tissu::all()->with('tissu_type');

     return response()->json($tissus, 200);
    }

}
