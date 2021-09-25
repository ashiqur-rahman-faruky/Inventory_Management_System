<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Employee;
use Image;

class empController extends Controller
{
    public function index(){
        $employees = Employee::all();
        return response()->json($employees);
    }

    public function store(Request $request){
        // dd($request->all());
        $validateData = $request->validate([
            'name' => 'required',
            'DOB' => 'required',
            'phone' => 'required|unique:employees',
            'email' => 'required|unique:employees',
            'address' => 'required',
            'joining_date' => 'required',
        ]);

        $data = array(
            'name' => $request->name,
            'DOB' => $request->DOB,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'nid' => $request->nid,
            'joining_date' => $request->joining_date,
            'created_at' => date('Y-m-d H:i:s')
        );

        if($request->photo){
            // for image extension
            $second_position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $second_position);
            $extension = explode('/', $sub)[1];

            $name = time().".".$extension;
            $image = Image::make($request->photo)->resize(240,240);
            $upload_path = 'backend/images/employee/';
            $image_url = $upload_path.$name;
            $image->save($image_url);
            $image_data = array('photo' => $image_url);
            $data = array_merge($data, $image_data);
        }

        Employee::insert($data);
    }

    public function show($id){
        $employee = Employee::where('id', $id)->first();
        return response()->json($employee);
    }

    public function update(Request $request, $id){
        // dd($request->all());
        $validateData = $request->validate([
            'name' => 'required',
            'DOB' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
            'joining_date' => 'required',
        ]);

        $data = array(
            'name' => $request->name,
            'DOB' => $request->DOB,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'nid' => $request->nid,
            'joining_date' => $request->joining_date,
            'created_at' => date('Y-m-d H:i:s')
        );        
        $employee = Employee::find($id);
        if($request->photo && $employee->photo != $request->photo){
            //unlink image
            $photo = $employee->photo;
            unlink($photo);
            
            // for image extension
            $second_position = strpos($request->photo, ';');
            $sub = substr($request->photo, 0, $second_position);
            $extension = explode('/', $sub)[1];

            $name = time().".".$extension;
            $image = Image::make($request->photo)->resize(240,240);
            $upload_path = 'backend/images/employee/';
            $image_url = $upload_path.$name;
            $image->save($image_url);
            $image_data = array('photo' => $image_url);
            $data = array_merge($data, $image_data);
        }

        Employee::where('id', $id)->update($data);
    }

    public function destroy($id) {
        $employee = Employee::find($id);
        $photo = $employee->photo;
        if($photo){
            unlink($photo);
        }
        Employee::find($id)->delete();
    }
}
