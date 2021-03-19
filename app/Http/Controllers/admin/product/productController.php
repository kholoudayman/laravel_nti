<?php

namespace App\Http\Controllers\admin\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\traits\generalTrait;

class productController extends Controller
{
    use generalTrait;
    public function index()
    {
        $products = DB::table('products')->get(); // array of objects vs. array of array
        return view('admin.product.products', compact('products'));
    }

    public function create()
    {
        $sub_categories_id = DB::table('sub_categories')->select('id', 'name')->where('status','=',1)->orderBy('name', 'ASC')->get();
        return view('admin.product.create', compact('sub_categories_id'));
    }

    public function edit($id)
    {
        $sub_categories_id = DB::table('sub_categories')->select('id', 'name')->where('status','=',1)->orderBy('name', 'ASC')->get();
        // get product from route parameter
        // get this product from db
        $product = DB::table('products')->where('id', '=', $id)->first();
        //print_r($product);die;
        return view('admin.product.edit', compact('product', 'sub_categories_id'));
    }

    public function store(Request $request)
    {
        
        // 1. Recieve Data: by taking one parameter of type request(post & get)
        // 2. Validation
        $rules = [
            'name'=>'required|string',
            'code'=>'required|unique:products,code',
            'price'=>'required|numeric|min:1|max:10000',
            'details'=>'required|string',
            'status'=>'required|between:0,1|integer',
            'sub_categories_id'=>'required|integer|exists:sub_categories,id',
            'stock' => 'required|integer',
            'photo'=>'required|max:4096|mimes:png,jpg,jpeg'

        ];
        $request->validate($rules);
        // 3. Upload Photo
        $filename = $this->uploadPhoto($request->photo, 'products');
        // 4. Insert data in DB
        $data = $request->except('_token', 'photo');
        $data['photo'] = $filename;
        $check = DB::table('products')->insert($data);
        // 5. Redirect to product page and display message
        if($check)
            return redirect('dashboard/products/')->with('Success', 'You Have Created A New Product Successfully');
        else
            return redirect('dashboard/products/')->with('Error', 'Something Went Wrong');
    }

    public function update(Request $request)
    {
        $rules = [
            'id'=>'required|integer|exists:products,id',
            'name'=>'required|string',
            'code'=>'required|integer',
            'price'=>'required|numeric|min:1|max:10000',
            'details'=>'required|string',
            'status'=>'required|between:0,1|integer',
            'sub_categories_id'=>'required|integer|exists:sub_categories,id',
            'stock' => 'required|integer',
            'photo'=>'nullable|max:4096|mimes:png,jpg,jpeg'
        ];
        $request->validate($rules);
        $data = $request->except('_token', '_method', 'photo');
        if($request->has('photo')){
            $filename = $this->uploadPhoto($request->photo, 'products');
            $data['photo'] = $filename;
        }
        $check = DB::table('products')->where('id', $request->id)->update($data);
        if($check)
            return redirect()->back()->with('Success', 'Product has been updated successfully');
        else
            return redirect()->back()->with('Error', 'No Changes Done');
    }

    public function destroy($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $path = public_path('images\products\\'. $product->photo);
        if(file_exists($path)){
            unlink($path);
        }
        DB::table('products')->where('id', $id)->delete();
        return redirect()->back()->with('Success', 'You have deleted product #' .$id.'successfully');
    }

}
