<?php

namespace App\Http\Controllers\admin\api\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Product;
use App\traits\generalTrait;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    use generalTrait;
    public function index()
    {
        // get all products from DB
        $products = Product::all();
        // return data as JSON
        return response()->json(['success'=>true,'products'=>$products], 200);
    }

    public function create(Request $request)
    {
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
        //$request->validate($rules);
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(['success'=>'false', 'validationError'=> $validator->errors()->toArray()], 400);
        }
        $filename = $this->uploadPhoto($request->photo, 'products');
        $data = $request->except('photo');
        $data['photo'] = $filename;
        $check = Product::insert($data);
        if($check)
            return response()->json(['success'=>'true', 'message'=> 'product has been added successfully'], 200);
        else    
            return response()->json(['success'=>'false', 'message'=>'something went wrong'], 500);
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
        // $request->validate($rules);
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(['success'=>'false', 'validationError'=> $validator->errors()->toArray()], 400);
        }
        $data = $request->except('photo');
        if($request->has('photo')){
            $filename = $this->uploadPhoto($request->photo, 'products');
            $data['photo'] = $filename;
        }
        $check = Product::where('id','=' , $request->id)->update($data);
        if($check)
            return response()->json(['success'=>'true', 'message'=> 'data has been updated successfully'], 200);
        else    
            return response()->json(['success'=>'false', 'message'=>'something went wrong'], 500);
    }

    public function destroy(Request $request)
    {
        $rules = [
            'id'=>'required|integer|exists:products',
        ];
        // $request->validate($rules);
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response()->json(['success'=>'false', 'validationError'=> $validator->errors()->toArray()], 400);
        }
        $product = Product::find($request->id);
        $path = public_path('images\products\\'. $product->photo);
        if(file_exists($path)){
            unlink($path);
        }
        $product->delete();
        return response()->json(['success'=>'true', 'message'=> 'products has been deleted successfully'], 200);
    }

}
