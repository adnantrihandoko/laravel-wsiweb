<?php

namespace App\Http\Controllers;

use App\Models\Pendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiPendidikanController extends Controller
{
    function getAll(){
        $pendidikan = Pendidikan::all();
        return Response::json($pendidikan, 201);
    }

    function getPen(Request $request){
        $id = $request->id;
        $pendidikan = Pendidikan::find($id);
        return Response::json($pendidikan);
    }

    function createPen(Request $request){
        $data = $request->all();
        Pendidikan::create($data);
        return Response::json([
            'status' => 'ok',
            'message' => 'data berhasil dibuat',
        ], 201);
    }

    function updatePen($id, Request $request){
        Pendidikan::find($id)->update($request->all());
        return response()->json([
            'status' => 'ok',
            'message' => 'data berhasil diubah',
        ], 201);
    }

    function deletePen($id){
        Pendidikan::destroy($id);
        return response()->json([
            'status' => 'ok',
            'message' => 'data berhasil dihapus',
        ],201);
    }
}
