<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    function index(){
        $products = Product::all();
        return view('project')->with(array('products' => $products));
    }

    function store(Request $request){
        $rules = [
            'price' => 'required|regex:/^\d*(\.\d{1,4})?$/',
            'name' => 'required|max:100'
        ];
        $this->validate($request, $rules);

        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        $product->save();
        return response()->json([
            'status' => 'Success',
            'message'    => 'Product added successfully',
            'product' => $product
        ], 200);
    }
}
