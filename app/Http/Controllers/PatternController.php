<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Pattern;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Mockery\Undefined;

class PatternController extends Controller
{
    public function getPatterns(Request $request)
    {
        $user = User::whereId($request->user()->id)->first();

        $Patterns = Pattern::where('user_id', $user->id)->get();

        return response()->json($Patterns, 200);
    }

    public function getPattern(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id'  => 'required|exists:patterns,id',
            ]
        );

        if ($validator->fails() === true) {
            return response()->json($validator->errors(), 400);
        }

        $user = User::whereId($request->user()->id)->first();

        $pattern = Pattern::where('user_id', $user->id)->where('id', $request->id)->first();

        return response()->json($pattern, 200);
    }

    public function storePattern(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id'                    => 'sometimes|exists:patterns,id',
                'name'                  => 'required|string',
                'brand'                 => 'required|string',
                'support'               => 'nullable|required_without:newSupport', Rule::in(['pdf', 'pochette', 'magazine']),
                'newSupport'            => 'nullable|required_without:support', Rule::in(['pdf', 'pochette', 'magazine']),
                'clothing_type'         => 'required|string',
                'silhouette'            => 'required|string',
                'rating'                => 'required|numeric',
                'comment'               => 'nullable|string',
                'user_id'               => 'required|numeric|exists:users,id'
            ]
        );

        if ($validator->fails() === true) {
            return response()->json($validator->errors(), 400);
        }

        if (isset($request->id) === true) {
            $pattern = Pattern::whereId($request->id)->first();
        } else {
            $pattern = new Pattern;
        }

        $pattern->name              = $request->name;
        $pattern->brand             = $request->brand;
        $pattern->support           = $request->support ? $request->support : $request->newSupport;
        $pattern->clothing_type     = $request->clothing_type;
        $pattern->silhouette        = $request->silhouette;
        $pattern->rating            = $request->rating;
        $pattern->comment           = $request->comment;
        $pattern->user_id           = $request->user_id;
        $pattern->save();

        return response()->json($request->all(), 200);
    }

    public function deletePattern(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['id' => 'sometimes|numeric|exists:patterns,id']
        );

        if ($validator->fails() === true) {
            return response()->json($validator->errors(), 400);
        }

        $pattern = Pattern::find($request->id);

        if (isset($pattern) === true) {
            $pattern->delete();
        };

        return response()->json(['success' => true, 'data' => $pattern], 200);
    }
}
