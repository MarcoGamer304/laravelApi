<?php

namespace App\Http\Controllers\Api;

use App\Constants;
use App\Http\Controllers\Controller;
use App\Models\TerrainBase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class terrainBaseController extends Controller
{
    function getTerrain($id)
    {
        $terrain = TerrainBase::find($id);
        if ($terrain === null) {
            return response()->json(Constants::GET_DATA, 404);
        }
        return response()->json($terrain, 200);
    }

    function getAllUser()
    {
        $terrain = TerrainBase::all();
        if ($terrain->isEmpty()) {
            return response()->json(Constants::GET_DATA, 404);
        }
        return response()->json($terrain, 200);
    }

    function postTerrain(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "terrain_base" => "required",
            "build_admin" => "required",
        ]);

        if ($validator->fails()) {
            $data = [
                "message" => "Content didnt match",
                "errors" => $validator->errors(),
                "status" => 400
            ];
            return response()->json($data, 400);
        }

        $terrain = TerrainBase::create([
            'terrain_base' => json_encode($request->terrain_base),
            'build_admin' => json_encode($request->build_admin),
        ]);

        if (!$terrain) {
            $data = [
                "message" => "error al registrar el terreno",
                "status" => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            "message" => "terreno creado exitosamente",
            "status" => 201
        ];
        return response()->json($data, 201);
    }
}
