<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintResource;
use App\Http\Resources\FeedbackResource;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Complaint;
use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    public function logCustomer()
    {
        $logged_in=Customer::where('user_id',Auth::user()->id)->first();
        return $logged_in;
    }
    public function index(Request $request)
    {
        $complaint = Complaint::with('customer', 'category')->
        where('cust_id', $this->logCustomer()->id)->get();
        // return $complaint;
        if ($complaint->isEmpty()) {
            return response()->json([
                'meta' => [
                    'code' => 404,
                    'status' => 'Failed',
                    'message' => 'Data Complaint Not Found'
                ],
            ],200);
        }else {
            return response()->json([
                'meta' => [
                    'code'  => 200,
                    'status' => 'success',
                    'message' => 'Data Complaint Found'
                ],
                'data' => [
                    'complaint' => $complaint
                ],
            ]);
        }
    }

    public function show($id)
    {
        $complaint = Complaint::find($id);
        if ($complaint) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Detail Complaint'
                ],
                'data' => [
                    'complaints' => new ComplaintResource($complaint)
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

    public function add(Request $request)
    {
        $data = $request->all();
        $getCategoryId=Category::where('name',$request->name)->first();
        // return $getCategoryId->id;
        $rules = [
            'cust_id'=> 'required',
            'type'=> 'required',
            'judul'=> 'required',
            'deskripsi'=> 'required',
            // 'tanggal'=> 'required',
            'bukti'=> 'required',
        ];
        $bukti = null;
        if ($request->bukti instanceof UploadedFile) {
            $bukti = $request->bukti->store('bukti', 'public');
            $data['bukti'] = $bukti;
        }else{
            unset($data['bukti']);
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $complaint = Complaint::create([
            'cust_id' => $request->cust_id,
            'category_id' => $getCategoryId->id,
            'type' => $request->type,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => Carbon::now(),
            'status' => 'Terkirim',
            'bukti' => $bukti,
        ]);
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'Success',
                'message' => 'Data Complaint Created'
            ],
            // 'data' => [
            //     'complaint' => $complaint
            // ]
        ],200);
    }
    public function feedback(Request $request,$id)
    {
        $complaint = Complaint::find($id);
        $data = $request->all();
        $rules = [
            'feedback_score'         => 'required',
            'feedback_deskripsi'         => 'required',
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $complaint->update($data);
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data Complaint updated successfully'
            ]
        ],200);
    }

}
