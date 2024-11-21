<?php

namespace App\Http\Controllers\Api;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\UserInformation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class userInformationController extends Controller
{
    function getUser($id)
    {
        $user = UserInformation::find($id);
        if ($user === null) {
            return response()->json(Constants::GET_DATA, 404);
        }
        return response()->json($user, 200);
    }

    function getAllUser()
    {
        $user = UserInformation::all();
        if ($user->isEmpty()) {
            return response()->json(Constants::GET_DATA, 404);
        }
        return response()->json($user, 200);
    }

    function postUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required|unique:user_information",
            "email" => "required|email|unique:user_information",
            "password" => "required",
            "contry" => "required",
            "language" => "required",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Content didnt match",
                "errors" => $validator->errors(),
                "status" => 400
            ];
            return response()->json($data, 400);
        }

        $user = userInformation::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contry' => $request->contry,
            'language' => $request->language,
        ]);

        if (!$user) {
            $data = [
                "message" => "error al registrar el usuario",
                "status" => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            "message" => "usuario creado exitosamente",
            "status" => 201
        ];
        return response()->json($data, 201);
    }

    function putUser(Request $request, $id)
    {
        $user = UserInformation::find($id);

        if (!$user) {
            return response()->json(Constants::GET_DATA, 404);
        }

        $validator = Validator::make($request->all(), [
            "username" => "required|unique:user_information",
            "email" => "required|email",
            "password" => "required",
            "contry" => "required",
            "language" => "required",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Content didnt found",
                "errors" => $validator->errors(),
                "status" => 400
            ];
            return response()->json($data, 400);
        }

        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->contry = $request->contry;
        $user->language = $request->language;

        $user->save();

        $data = [
            "message" => "usuario actualizado correctamente",
            "user" => $user,
            "status" => 200
        ];
        return response()->json($data, 200);
    }

    function patchUser(Request $request, $id)
    {
        $user = UserInformation::find($id);

        if(!$user){
            return response()->json(Constants::GET_DATA,404);
        }

        $validator = Validator::make($request->all(), [
            "username" => "unique:user_information",
            "email" => "email|unique:user_information",
            "password" => "",
            "contry" => "",
            "language" => "",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Content didnt found",
                "errors" => $validator->errors(),
                "status" => 400
            ];
            return response()->json($data, 400);
        }

        if($request->has('username')){ $user->username = $request->username; }
        if($request->has('email')){ $user->email = $request->email; }
        if($request->has('password')){ $user->password = Hash::make($request->password); }
        if($request->has('contry')){ $user->contry = $request->contry; }
        if($request->has('language')){ $user->language = $request->language; }

        $user->save();

        $data = [
            "message" => "usuario actualizado correctamente",
            "user" => $user,
            "status" => 200
        ];
        return response()->json($data,200);
    }

    function deleteUser($id)
    {
        $user = UserInformation::find($id);

        if (!$user) {
            return response()->json(Constants::GET_DATA, 404);
        }

        $user->delete();

        $data = [
            "message" => "usuario eliminado correctamente",
            "status" => 200
        ];

        return response()->json($data, 200);
    }
}
