<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    function products(){
        $products = Product::all();
        return view('project')->with(array('products' => $products));
    }
}
