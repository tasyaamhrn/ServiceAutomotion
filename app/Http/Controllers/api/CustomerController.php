<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Exception;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;

class CustomerController extends Controller
{
    public function register(Request $request){
        $data = $request->all();
        $rules = [
            'nik' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],

        ];
        $ktp = null;
        if ($request->ktp instanceof UploadedFile) {
            $ktp = $request->ktp->store('ktp', 'public');
            $data['ktp'] = $ktp;
        }else{
            unset($data['ktp']);
        }

        $avatar = null;
        if ($request->avatar instanceof UploadedFile) {
            $avatar = $request->avatar->store('avatar', 'public');
            $data['avatar'] = $avatar;
        }else{
            unset($data['avatar']);
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $register = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 3
        ]);
        $customer = Customer::create([
            'name' => $request->name,
            'nik'  => $request->nik,
            'address' => $request->address,
            'avatar' => $avatar,
            'phone' => $request->phone,
            'user_id' => $register->id,
            'ktp' => $ktp,
            'status' => 'Waiting',

        ]);
        if ($register) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'Success',
                    'message' => 'Data Customer Created'
                ],
                'data' => [

                    'customer'        => $customer
                ]
            ]);
        } else {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' => 'Failed',
                    'message' => "Registration Failed"
                ],],200);
        }
    }
    public function download_ktp($customer_id)
    {
        $download = Customer::find($customer_id);
        $pathFile = storage_path('app\public/'. $download->ktp);

        return response()->download($pathFile);
    }

    public function login(Request $request){
        try {
            $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);
            //Check Credentials
            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'meta' => [
                        'code' => 500,
                        'status' => 'Failed',
                        'message' => "Wrong Email or Password"
                    ],],200);
            }
            // Jika Hash Tidak sesuai maka Error
            $user = User::where('email', $request->email)->first();
            $user->tokens()->delete();
            $token = $user->createToken('tokens')->accessToken;
            $customer = Customer::where('user_id', $user->id)->first();
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'Success',
                    'message' => 'Authenticated'
                ],
                'data' => [
                    'accessToken' => $token,
                    'token_type'  => 'Bearer',
                    'user'        => $user,
                    'customer' => $customer
                ],

                // 'subscribers' => new UserDataResource($user)
            ]);

        } catch (Exception $error ) {
            return response()->json([
                'meta' => [
                    'code' => 500,
                    'status' =>'Failed',
                    'message' => "Authentication Failed " . $error
                ],
                // 'message' => "Authentication Failed " . $error
            ]);
        }
    }
    public function riview(Request $request, $id ){
        $data = $request->all();
        $rules = [
            'name'          => 'required',
            'address'       => 'required',
            'phone'         => 'required',
        ];
        $this->validate($request, [
        ]);
        $customer = Customer::find($id);
        $customer->status = 'waiting';
        if (request()->hasFile('avatar')) {
            $avatar = request()->file('avatar')->store('avatar', 'public');
            if (Storage::disk('public')->exists($customer->avatar)) {
                Storage::disk('public')->delete([$customer->avatar]);
            }
            $avatar = request()->file('avatar')->store('avatar', 'public');
            $data['avatar'] = $avatar;
            $customer->update($data);
        }else{
            unset($data['avatar']);
        }
        if (request()->hasFile('ktp')) {
            $ktp = request()->file('ktp')->store('ktp', 'public');
            if (Storage::disk('public')->exists($customer->ktp)) {
                Storage::disk('public')->delete([$customer->ktp]);
            }
            $ktp = request()->file('ktp')->store('ktp', 'public');
            $data['ktp'] = $ktp;
            $customer->update($data);
        }else{
            unset($data['ktp']);
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
          return response()->json($validator->errors(), 400);
        }
        $customer->update($data);
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data Customer updated successfully'
            ],
            'data' => [

                'customer' => $customer
            ]
        ]);

    }
    public function update(Request $request, $id )
    {
        $data = $request->all();
        $rules = [
            'name'          => 'required',
            'address'       => 'required',
            'phone'         => 'required',
        ];
        $this->validate($request, [
        ]);
        $customer = Customer::find($id);
        // if (!$customer) {
        //     return response()->json([
        //         'meta' => [
        //             'code' => 404,
        //             'status' => 'Failed',
        //             'message' => 'Customer Not Found'
        //         ],

        //     ],200);
        // }
        if (request()->hasFile('avatar')) {
            $avatar = request()->file('avatar')->store('avatar', 'public');
            if (Storage::disk('public')->exists($customer->avatar)) {
                Storage::disk('public')->delete([$customer->avatar]);
            }
            $avatar = request()->file('avatar')->store('avatar', 'public');
            $data['avatar'] = $avatar;
            $customer->update($data);
        }else{
            unset($data['avatar']);
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
          return response()->json($validator->errors(), 400);
        }
        $customer->update($data);
        return response()->json([
            'meta' => [
                'code' => 200,
                'status' => 'success',
                'message' => 'Data Customer updated successfully'
            ],
            'data' => [

                'customer' => $customer
            ]
        ]);

    }

    public function check($id){
        $customer = Customer::findOrFail($id);
        $user = User::where('id', $customer->user_id)->first();
        if ($customer) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Detail Customer',
                ],
                'data' => [
                    'user'        => $user,
                    'customer' => $customer
                ],
            ],200);
        }else {
            return response()->json([
                'meta' => [
                    'code' => 404,
                    'status' => 'Failed',
                    'message' => 'Customer Not Found'
                ],
            ],200);
        }
    }
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $user = User::where('id', $customer->user_id)->first();
        if ($customer) {
            return response()->json([
                'meta' => [
                    'code' => 200,
                    'status' => 'success',
                    'message' => 'Detail Customer',
                ],
                'data' => [
                    'user'        => $user,
                    'customer' => $customer
                ],
            ],200);
        }else {
            return response()->json([
                'meta' => [
                    'code' => 404,
                    'status' => 'Failed',
                    'message' => 'Customer Not Found'
                ],
            ],200);
        }

    }
    public function logout()
    {
        $user = request()->user();
        $access_token = $user->token();

        // logout from only current device
        $tokenRepository = app(TokenRepository::class);
        $tokenRepository->revokeAccessToken($access_token->id);

        // use this method to logout from all devices
        // $refreshTokenRepository = app(RefreshTokenRepository::class);
        // $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($$access_token->id);

        return response()->json([
            'success' => true,
            'message' => 'User logout successfully.'
        ], 200);
    }
}
