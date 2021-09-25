<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Supplier;
use Image;

class supplierController extends Controller
{
    public function index()
    {
        $supplier = Supplier::all();
        return response()->json($supplier);
    }

    public function create()
    {
    
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'phone' => 'required|unique:suppliers',
            'email' => 'required|unique:suppliers',
            'address' => 'required',
        ]);

        $data = array(
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'shopName' => $request->shopName,
            'created_at' => date('Y-m-d H:i:s')
        );
        if($request->photo){
            // for image extension
            $second_position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $second_position);
            $extension = explode('/', $sub)[1];

            $name = time().".".$extension;
            $image = Image::make($request->photo)->resize(240,240);
            $upload_path = 'backend/images/supplier/';
            $image_url = $upload_path.$name;
            $image->save($image_url);
            $image_data = array('photo' => $image_url);
            $data = array_merge($data, $image_data);
        }
        Supplier::insertGetId($data);
    }

    public function show($id)
    {
        $supplier = Supplier::where('id', $id)->first();
        return response()->json($supplier);
    }


    public function edit($id)
    {
       
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $data = array(
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'shopName' => $request->shopName,
            'created_at' => date('Y-m-d H:i:s')
        );     
        $supplier = Supplier::find($id);
        if($request->photo && $supplier->photo != $request->photo){
            //unlink image
            $photo = $supplier->photo;
            unlink($photo);

            // for image extension
            $second_position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $second_position);
            $extension = explode('/', $sub)[1];

            $name = time().".".$extension;
            $image = Image::make($request->photo)->resize(240,240);
            $upload_path = 'backend/images/supplier/';
            $image_url = $upload_path.$name;
            $image->save($image_url);
            $image_data = array('photo' => $image_url);
            $data = array_merge($data, $image_data);
        }
        
        Supplier::where('id', $id)->update($data);
    }
    
    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        // dd($supplier);
        $photo = $supplier->photo;
        if($photo){
            unlink($photo);
        }
        Supplier::find($id)->delete();
    }
}
