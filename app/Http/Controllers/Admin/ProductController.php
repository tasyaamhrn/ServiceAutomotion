<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\blok;
use App\Models\Product;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $blok = blok::get();
        $employee = Employee::get();
        $department = Department::all();
        $product = Product::all();
        $logged_in = Auth::id();
        if (Auth::user()->role_id == 1) {
            $roles = Auth::user()->roles->name;
            $name = $roles;
        }else {
            $employee_name = Employee::where('user_id', $logged_in)->select('name')->get();
            $name = $employee_name[0]->name;
        }
        return view('admin.product', compact('product','blok', 'department', 'name'));

    }
    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     // return $request;
    //     $this->validate($request, [
    //         'blok' => 'required',
    //         'no_kavling' => 'required',
    //         'type' => 'required',
    //         'luas_tanah' => 'required',
    //         'price' => 'required',
    //         'status' => 'required',
    //         'tanah_lebih' => 'required',
    //         'discount' => 'required',
    //     ]);
    //     if ($request->image){
    //         $file =$request->file('image');
    //         $ext=$file->getClientOriginalExtension();
    //         $name='image/'.date('dmYhis').".".$ext;
    //         $file->move('image/',$name);
    //         $product = Product::create([
    //             'blok' => $request->blok,
    //             'no_kavling' => $request->no_kavling,
    //             'type' => $request->type,
    //             'luas_tanah' => $request->luas_tanah,
    //             'price' => $request->price,
    //             'status' => $request->status,
    //             'tanah_lebih' => $request->tanah_lebih,
    //             'discount' => $request->discount,
    //             'image' => $name,

    //         ]);
    //         // $employee->avatar=$name;
    //     }
    //     else{$product = Product::create([
    //         'blok' => $request->blok,
    //         'no_kavling' => $request->no_kavling,
    //         'type' => $request->type,
    //         'luas_tanah' => $request->luas_tanah,
    //         'price' => $request->price,
    //         'status' => $request->status,
    //         'tanah_lebih' => $request->tanah_lebih,
    //         'discount' => $request->discount,


    //     ]);}
    //     return redirect('/product');
    // }
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            'blok' => ['required'],
            'no_kavling' => ['required'],
            'type' => ['required'],
            'luas_tanah' => ['required'],
            'price' => ['required'],
            'status' => ['required'],
            'dinding' => ['required'],
            'pondasi' => ['required'],
            'lantai' => ['required'],
            'rangka_atap' => ['required'],
            'penutup_atap' => ['required'],
            'daun_pintu' => ['required'],
            'plafon' => ['required'],
            'kusen' => ['required'],
            'kamar_mandi' => ['required'],
            'sumber_air' => ['required'],
            'listrik' => ['required'],
            'tanah_lebih' => ['required'],
            'discount' => ['required'],
        ];
        $image = null;
        if ($request->image instanceof UploadedFile) {
            $image = $request->image->store('image', 'public');
            $data['image'] = $image;
        }else{
            unset($data['image']);
        }
        $imagedua = null;
        if ($request->imagedua instanceof UploadedFile) {
            $imagedua = $request->imagedua->store('image', 'public');
            $data['imagedua'] = $imagedua;
        }else{
            unset($data['imagedua']);
        }
        $imagetiga = null;
        if ($request->imagetiga instanceof UploadedFile) {
            $imagetiga = $request->imagetiga->store('image', 'public');
            $data['imagetiga'] = $imagetiga;
        }else{
            unset($data['imagetiga']);
        }
        $imageempat = null;
        if ($request->imageempat instanceof UploadedFile) {
            $imageempat = $request->imageempat->store('image', 'public');
            $data['imageempat'] = $imageempat;
        }else{
            unset($data['imageempat']);
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        Product::create([
            'blok' => $request->blok,
            'no_kavling' => $request->no_kavling,
            'type' => $request->type,
            'luas_tanah' => $request->luas_tanah,
            'price' => $request->price,
            'status' => $request->status,
            'dinding'=> $request->dinding,
            'pondasi'=> $request->pondasi,
            'lantai'=> $request->lantai,
            'rangka_atap'=> $request->rangka_atap,
            'penutup_atap'=> $request->penutup_atap,
            'daun_pintu'=> $request->daun_pintu,
            'plafon'=> $request->plafon,
            'kusen'=> $request->kusen,
            'kamar_mandi'=> $request->kamar_mandi,
            'sumber_air'=> $request->sumber_air,
            'listrik'=> $request->listrik,
            'tanah_lebih' => $request->tanah_lebih,
            'discount' => $request->discount,
            'image' => $image,
            'imagedua' => $imagedua,
            'imagetiga' => $imagetiga,
            'imageempat' => $imageempat,
        ]);
        toast('Your Product has been submited!','success');
        return redirect('/product');
    }

    public function update($id,Request $request)
    {
        $data = $request->all();
        $rules = [
            'blok' => ['required'],
            'no_kavling' => ['required'],
            'type' => ['required'],
            'luas_tanah' => ['required'],
            'price' => ['required'],
            'status' => ['required'],
            'dinding' => ['required'],
            'pondasi' => ['required'],
            'lantai' => ['required'],
            'rangka_atap' => ['required'],
            'penutup_atap' => ['required'],
            'daun_pintu' => ['required'],
            'plafon' => ['required'],
            'kusen' => ['required'],
            'kamar_mandi' => ['required'],
            'sumber_air' => ['required'],
            'listrik' => ['required'],
            'tanah_lebih' => ['required'],
            'discount' => ['required'],
        ];
        $this->validate($request, [
        ]);
        $product = Product::find($id);

        if (request()->hasFile('image')) {
            $image = request()->file('image')->store('image', 'public');
            if (Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete([$product->image]);
            }
            $image = request()->file('image')->store('image', 'public');
            $data['image'] = $image;
            $product->update($data);
        }else{
            unset($data['image']);
        }
        if (request()->hasFile('imagedua')) {
            $image = request()->file('imagedua')->store('image', 'public');
            if (Storage::disk('public')->exists($product->imagedua)) {
                Storage::disk('public')->delete([$product->imagedua]);
            }
            $imagedua = request()->file('imagedua')->store('image', 'public');
            $data['imagedua'] = $imagedua;
            $product->update($data);
        }else{
            unset($data['imagedua']);
        }
        if (request()->hasFile('imagetiga')) {
            $imagetiga = request()->file('imagetiga')->store('image', 'public');
            if (Storage::disk('public')->exists($product->imagetiga)) {
                Storage::disk('public')->delete([$product->imagetiga]);
            }
            $imagetiga = request()->file('imagetiga')->store('image', 'public');
            $data['imagetiga'] = $imagetiga;
            $product->update($data);
        }else{
            unset($data['imagetiga']);
        }
        if (request()->hasFile('imageempat')) {
            $imageempat = request()->file('imageempat')->store('image', 'public');
            if (Storage::disk('public')->exists($product->imageempat)) {
                Storage::disk('public')->delete([$product->imageempat]);
            }
            $image = request()->file('imageempat')->store('image', 'public');
            $data['imageempat'] = $imageempat;
            $product->update($data);
        }else{
            unset($data['imageempat']);
        }
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $product->update($data);
        toast('Product Updated!','success');
        return redirect('/product');
    }
    public function destroy($id){
        $product = Product::findOrFail($id);
        $product->delete();
        toast('Product has been Deleted!','success');
        return redirect('/product');
    }
}
