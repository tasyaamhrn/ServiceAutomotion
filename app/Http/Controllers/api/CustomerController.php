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
}
