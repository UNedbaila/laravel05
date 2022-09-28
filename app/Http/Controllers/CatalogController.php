<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function __invoke(){
        $products = Product::query()
            ->where('active', 1)
            ->limit(10)
            //->first()
            ->get();

        $categories = Category::withCount('products')->get();
        return view('site.store', compact('products','categories'));
    }

    public function product(Request $request, $category_id, $product_id){

        $category = Product::find($category_id);
        $product = Product::find($product_id);

        return view("site.product", compact("category", "product"));
    }
}
