<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use Image;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'categories.id', 'products.category_id')
            ->join('suppliers', 'suppliers.id', 'products.supplier_id')
            ->select('suppliers.name as supplier_name', 'categories.category_name', 'products.*')
            ->orderby('products.id', 'desc')
            ->get();
            // dd($products);
        return response()->json($products);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'category_id' => 'required',
            'product_name' => 'required|unique:products',
            'product_code' => 'required|unique:products',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'supplier_id' => 'required',
            'product_quantity' => 'required',
        ]);

        $data = array(
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'root' => $request->root,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'supplier_id' => $request->supplier_id,
            'product_quantity' => $request->product_quantity,
            'buying_date' => $request->buying_date,
            'created_at' => date('Y-m-d H:i:s')
        );

        if($request->image){
            // for image extension
            $second_position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $second_position);
            $extension = explode('/', $sub)[1];

            $name = time().".".$extension;
            $image = Image::make($request->image)->resize(240,240);
            $upload_path = 'backend/images/product/';
            $image_url = $upload_path.$name;
            $image->save($image_url);
            $image_data = array('image' => $image_url);
            $data = array_merge($data, $image_data);
        }

        Product::insert($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::where('id', $id)->first();
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validateData = $request->validate([
            'category_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'supplier_id' => 'required',
            'product_quantity' => 'required',
        ]);

        $data = array(
            'category_id' => $request->category_id,
            'product_name' => $request->product_name,
            'product_code' => $request->product_code,
            'root' => $request->root,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'supplier_id' => $request->supplier_id,
            'product_quantity' => $request->product_quantity,
            'buying_date' => $request->buying_date,
            'created_at' => date('Y-m-d H:i:s')
        );
        $product = Product::find($id);
        if($request->image && $request->image != $product->image){
            //unlink image
            $image = $product->image;
            unlink($image);
            // for image extension
            $second_position = strpos($request->image, ';');
            $sub = substr($request->image, 0, $second_position);
            $extension = explode('/', $sub)[1];

            $name = time().".".$extension;
            $image = Image::make($request->image)->resize(240,240);
            $upload_path = 'backend/images/product/';
            $image_url = $upload_path.$name;
            $image->save($image_url);
            $image_data = array('image' => $image_url);
            $data = array_merge($data, $image_data);
        }

        Product::where('id', $id)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $image = $product->image;
        if($image){
            unlink($image);
        }
        Product::find($id)->delete();
    }
}
