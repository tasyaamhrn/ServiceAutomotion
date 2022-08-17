<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordRequest;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Employee;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit(){
        $employee = Employee::get();

        $logged_in = Auth::id();
        if (Auth::user()->role_id == 1) {
            $roles = Auth::user()->roles->name;
            $name = $roles;
        }else {
            $employee_name = Employee::where('user_id', $logged_in)->select('name')->get();
            $name = $employee_name[0]->name;
        }
        return view('admin.password', compact('employee', 'name'));

    }
    public function update(UpdatePasswordRequest $request)
{

    $request->user()->update([
        'password' => Hash::make($request->get('password'))
    ]);
    Alert::success('Congrats', 'Password Update Successfully');
    return redirect()->route('user.password.edit');
}
}
