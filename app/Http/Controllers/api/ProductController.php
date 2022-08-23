<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintResource;
use App\Models\blok;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
class ProductController extends Controller
{
    // public function index()
    // {
    //     $product = Product::where('status', 'Available')->get();
    //     return response()->json([
    //         'meta' => [
    //             'code' => 200,
    //             'status' => 'success',
    //             'message' => 'Data Product'
    //         ],
    //         'data' => [
    //             'product' => $product
    //         ]
    //     ],200);

    // }
    public function rumah(Request $request, $id)
    {
        $blok = blok::findOrFail($id);
        $product = Product::with('blok')->
        where('blok', $blok->id)->where('status', 'Available')->get();
        // return $complaint;
        if ($product->isEmpty()) {
            return response()->json([
                'meta' => [
                    'code' => 404,
                    'status' => 'Failed',
                    'message' => 'Data Product Not Found'
                ],
            ],200);
        }else {
            return response()->json([
                'meta' => [
                    'code'  => 200,
                    'status' => 'success',
                    'message' => 'Data Product Found'
                ],
                'data' => [
                    'product' => $product
                ],
            ]);
        }
    }
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Detail Product'
                ],
                'data' => [
                    'products' => $product
                ]
            ],200);
        }else {
            return response()->json([
                'meta' => [
                    'code' => 404,
                    'status' => 'Failed',
                    'message' => 'Data Not Found',
                ],
            ],200);;
        }
    }

}
