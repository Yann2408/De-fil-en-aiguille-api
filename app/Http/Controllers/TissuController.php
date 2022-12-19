<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tissu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TissuController extends Controller
{

    public function getTissus()
    {
        $tissus = Tissu::with('tissu_type')->get();

        return response()->json($tissus, 200);
    }


    public function getTissu(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id'                => 'required|exists:tissus,id',
            ]
        );

        if ($validator->fails() === true) {
            return response()->json($validator->errors(), 400);
        }

        $tissu = Tissu::with('tissu_type')->where('id',$request->id)->first();

        return response()->json($tissu, 200);
    }


    public function storeTissu(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'id'                => 'sometimes|exists:tissus,id',
                'name'              => 'required|string',
                'tissu_type.id'     => 'required|numeric|exists:tissu_types',
                'weight'            => 'required|numeric',
                'laize'             => 'required|numeric',
                'price'             => 'required|numeric',
                'stock'             => 'required|numeric',
                'by_on'             => 'required|string',
                'scrap'             => 'required|boolean',
                'oekotex'           => 'required|boolean',
                'bio'               => 'required|boolean',
                'pre_wash'          => 'required|boolean',
                'rating'            => 'required|numeric',
                'comment'           => 'nullable|string',
            ]
        );

        if ($validator->fails() === true) {
            return response()->json($validator->errors(), 400);
        }

        if (isset($request->id) === true) {
            $tissu = Tissu::whereId($request->id)->first();
        } else {
            $tissu = new Tissu;
        }

        $tissu->name = $request->name;
        $tissu->weight = $request->weight;
        $tissu->laize = $request->laize;
        $tissu->price = $request->price;
        $tissu->stock = $request->stock;
        $tissu->by_on = $request->by_on;
        $tissu->scrap = $request->scrap;
        $tissu->oekotex = $request->oekotex;
        $tissu->bio = $request->bio;
        $tissu->pre_wash = $request->pre_wash;
        $tissu->rating = $request->rating;
        $tissu->comment = $request->comment;
        $tissu->save();

        return response()->json($tissu, 200);
    }
}
