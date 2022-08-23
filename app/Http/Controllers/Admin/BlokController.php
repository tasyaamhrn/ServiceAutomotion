<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\blok;
use App\Models\Employee;
use App\Models\perumahan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BlokController extends Controller
{
    public function index()
    {
        $blok = blok::all();
        $perumahan = perumahan::get();
        $employee = Employee::get();
        $logged_in = Auth::id();
        if (Auth::user()->role_id == 1) {
            $roles = Auth::user()->roles->name;
            $name = $roles;
        }else {
            $employee_name = Employee::where('user_id', $logged_in)->select('name')->get();
            $name = $employee_name[0]->name;
        }
        return view('admin.blok', compact('blok','perumahan', 'employee', 'name'));
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [

            'name' => ['required'],
            'id_perumahan' => ['required'],
            'denah' => ['required'],

        ];
        $denah = null;
        if ($request->denah instanceof UploadedFile) {
            $denah = $request->denah->store('denah', 'public');
            $data['denah'] = $denah;
        }else{
            unset($data['denah']);
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $blokk = blok::create([
            'name' => $request->name,
            'id_perumahan' => $request->id_perumahan,
            'denah' => $denah
        ]);
        toast('Your Post has been submited!','success');
        return redirect('/blok');
    }
    // public function update(Request $request, $id){
    //     $blok = blok::find($id);
    //     $blok->name = $request->input('name');
    //     $blok->id_perumahan = $request->input('id_perumahan');
    //     $blok->save();
    //     toast('Blok  has been Updated!','success');
    //     return redirect('/blok');
    // }
    public function update(Request $request, $id){
        $data = $request->all();
        $rules = [
            'name' => 'required',
            'id_perumahan' => 'required',
        ];
        $this->validate($request, [
        ]);
        $blok = blok::find($id);
        if (request()->hasFile('denah')) {
            $denah = request()->file('denah')->store('denah', 'public');
            if (Storage::disk('public')->exists($blok->denah)) {
                Storage::disk('public')->delete([$blok->denah]);
            }
            $denah = request()->file('denah')->store('denah', 'public');
            $data['denah'] = $denah;
            $blok->update($data);
        }else{
            unset($data['denah']);
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $blok->name=$request->name;
        $blok->id_perumahan=$request->id_perumahan;

        $blok->save();

        if( $blok->save()){
            toast('Blok Updated!','success');
            return redirect('/blok');
        }




    }
    public function destroy($id){
        $blok = blok::findOrFail($id);
        $blok->delete();
        toast('Blok has been Deleted!','success');
        return redirect('/blok');
    }
}
