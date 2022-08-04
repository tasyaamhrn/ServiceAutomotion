<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
class ProductController extends Controller
{
    public function index()
    {
        $product = Product::where('status', 'Available')->get();
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data Product'
            ],
            'data' => [
                'product' => $product
            ]
        ],200);

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
