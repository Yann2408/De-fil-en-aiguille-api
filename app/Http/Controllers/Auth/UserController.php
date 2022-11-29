<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{


    /**
     * Get own account
     *
     * @param Request $request Laravel request object
     *
     * @return string JSON
     */
    public function getMe(Request $request)
    {
        $user = User::whereId($request->user()->id)->first();
        return $user;

    }//end getMe()


    /**
     * Update own personal info
     *
     * @param Request $request Laravel request object
     *
     * @return string JSON
     */
    public function updatePersonalInfo(Request $request)
    {

        $user = User::find(Auth::id());

        $validator = Validator::make(
            $request->all(),
            [
                'firstname'          => [
                    'sometimes',
                    'string',
                    'max:100',
                ],
                'lastname'           => [
                    'sometimes',
                    'string',
                    'max:100',
                ],
            ]
        );

        if ($validator->fails() === true) {
            return response()->json(["errors" => $validator->errors()], 422);
        }

        $user->profile()->update(
            [
                'firstname'             => $request->firstname,
                'lastname'              => $request->lastname,
            ]
        );

        return response()->json(['success' => true, 'data' => $user], 200);

    }//end updatePersonalInfo()


    /**
     * Update own security info
     *
     * @param Request $request Laravel request object
     *
     * @return string JSON
     */
    public function updateSecurity(Request $request)
    {
        $user = User::find(Auth::id());

        $validator = Validator::make(
            $request->all(),
            [
                'email'            => [
                    'required',
                    'string',
                    'email',
                    'max:100',
                    'unique:users,email,'.$user->id,
                ],
                'current_password' => 'required|string',
                'new_password'     => 'nullable|required_with:old_password|string|confirmed|different:current_password',
            ]
        );

        if ($validator->fails() === true) {
            return response()->json(["errors" => $validator->errors()], 422);
        }

        if (Hash::check($request->current_password, $user->password) === true) {
            $user->password = Hash::make($request->new_password);
            $user->update($validator->validated());
        } else {
            $validator->getMessageBag()->add('current_password', 'incorrect');
            return response()->json(["errors" => $validator->errors()], 422);
        }

        return response()->json(['success' => true, 'data' => $user], 200);

    }//end updateSecurity()


}//end class
