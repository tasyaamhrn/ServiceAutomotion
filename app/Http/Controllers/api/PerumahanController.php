<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\perumahan;
use Illuminate\Database\QueryException;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PerumahanController extends Controller
{
    public function index(Request $request)
    {
        $perumahan = perumahan::get();
        $array=array();
        foreach($perumahan as $item){
            $array[]=$item;
        }
        $response = [
            'meta' => [
                'code'  => 200,
                'status' => 'success',
                'message' => 'Data Perumahan Found'
            ],
            'data' => [
                'perumahan' => $array
            ],
        ];
        return response()->json($response, Response::HTTP_OK);

    }
}
