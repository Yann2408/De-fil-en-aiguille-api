<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tissu;
use App\Models\TissuType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TissuController extends Controller
{

    public function getTissus(Request $request)
    {
        $user = User::whereId($request->user()->id)->first();

        $tissus = Tissu::where('user_id',$user->id)->with('tissu_type')->get();

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

        $user = User::whereId($request->user()->id)->first();

        $tissu = Tissu::with('tissu_type')->where('user_id',$user->id)->where('id',$request->id)->first();
        // $tissu = Tissu::with('tissu_type')->where('id',$request->id)->first();

        return response()->json($tissu, 200);
    }


    public function storeTissu(Request $request)
    {

        $validator = Validator::make(
            $request->all(),
            [
                'id'                    => 'sometimes|exists:tissus,id',
                'name'                  => 'required|string',
                'tissu_type'            => 'nullable|required_without:new_tissu_type|string',
                'new_tissu_type'        => 'nullable|required_without:tissu_type|string',
                'weight'                => 'required|numeric',
                'laize'                 => 'required|numeric',
                'price'                 => 'required|numeric',
                'stock'                 => 'required|numeric',
                'by_on'                 => 'required|string',
                'oekotex'               => 'required|boolean',
                'bio'                   => 'required|boolean',
                'pre_wash'              => 'required|boolean',
                'rating'                => 'required|numeric',
                'comment'               => 'nullable|string',
                'user_id'               => 'required|numeric|exists:users,id'
            ]
        );

        if ($validator->fails() === true) {
            return response()->json($validator->errors(), 400);
        }


        if (isset($request->id) === true) {
            $tissu = Tissu::whereId($request->id)->first();
            $tissuType = TissuType::where('name', $request->tissu_type)-> first();
        } else {
            $tissu = new Tissu;
            $tissuType = TissuType::where('name', $request->new_tissu_type)-> first();
        }

        $tissu->name = $request->name;
        $tissu->weight = $request->weight;
        $tissu->laize = $request->laize;
        $tissu->price = $request->price;
        $tissu->stock = $request->stock;
        $tissu->by_on = $request->by_on;
        $tissu->oekotex = $request->oekotex;
        $tissu->bio = $request->bio;
        $tissu->pre_wash = $request->pre_wash;
        $tissu->rating = $request->rating;
        $tissu->comment = $request->comment;
        $tissu->tissu_type_id = $tissuType->id;
        $tissu->user_id = $request->user_id;
        $tissu->save();

        return response()->json($request->all(), 200);
    }

    public function deleteTissu(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['id' => 'sometimes|numeric|exists:tissus,id']
        );

        if ($validator->fails() === true) {
            return response()->json($validator->errors(), 400);
        }

        $tissu = Tissu::find($request->id);

        if (isset($tissu) === true) {
            $tissu->delete();
        };

        return response()->json(['success' => true, 'data' => $tissu], 200);
    }
}
