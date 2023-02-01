<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TissuType;

class TissuTypeController extends Controller
{

    public function getTissuTypes()
    {
        $tissuTypes = TissuType::all();

     return response()->json($tissuTypes, 200);
    }

}
