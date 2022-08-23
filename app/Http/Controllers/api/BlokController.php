<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\blok;
use App\Models\perumahan;
use Illuminate\Http\Request;

class BlokController extends Controller
{
    public function show(Request $request, $id)
    {
        $perumahan = perumahan::findOrFail($id);
        $blok = blok::with('perumahan')->
        where('id_perumahan', $perumahan->id)->get();
        // return $complaint;
        if ($blok->isEmpty()) {
            return response()->json([
                'meta' => [
                    'code' => 404,
                    'status' => 'Failed',
                    'message' => 'Data Blok Not Found'
                ],
            ],200);
        }else {
            return response()->json([
                'meta' => [
                    'code'  => 200,
                    'status' => 'success',
                    'message' => 'Data Blok Found'
                ],
                'data' => [
                    'blok' => $blok
                ],
            ]);
        }
    }
}
