<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;


class ProductsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $pagination = 12;

      if(request()->category){
        $products = Product::with('categories')->whereHas('categories', function($query){
          $query->where('slug', request()->category);
        });
        $categories = Category::all();
        $categoryName = $categories->where('slug', request()->category)->first()->name;

      }else{
        $products = Product::where('featured',true);
        $categories = Category::all();
        $categoryName = 'Спртивное питание:';
      }

      if(request()->sort == 'low_high'){
        $products = $products->orderBy('price')->paginate($pagination);
      }elseif (request()->sort == 'high_low') {
        $products = $products->orderBy('price', 'desc')->paginate($pagination);
      }else{
        $products = $products->paginate($pagination);
      }

      return view('products')->with([
        'products' => $products,
        'categories' => $categories,
        'categoryName' => $categoryName,
      ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $sameView = Product::where('slug', '!=', $slug)->inRandomOrder()->take(4)->get();
        return view('product')->with([
          'product' => $product,
          'sameView' => $sameView,
        ]);
    }

}
