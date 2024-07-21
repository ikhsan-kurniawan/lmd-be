<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function show()
    {
        return response()->json(auth()->guard('api')->user(), 200);
    }

    // Profile Update API
    public function update(Request $request)
    {
        $user = auth()->user();

        // $validator = Validator::make($request->all(), [
        //     'username'      => 'required|min:3|max:20|alpha_dash|unique:users,username,',
        //     'email'         => 'required|email|unique:users,email,',
        //     'real_name'     => 'required',
        //     'phone'         => 'required',
        // ]);
        $validator = Validator::make($request->all(), [
            'username'      => 'required|min:3|max:20|alpha_dash|unique:users,username,' . $user->id,
            'email'         => 'required|email|unique:users,email,' . $user->id,
            'real_name'     => 'required',
            'phone'         => 'required|unique:users,phone,' . $user->id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user->update($request->all());

        return response()->json(['message' => 'Profil berhasil diupdate', 'user' => $user], 200);
    }
}
