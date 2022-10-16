<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __invoke()
    {
        //select * from products where active = 1 and category_id = 1 order by id desc
        $latestProducts = Product::query()
            ->where('active', 1)
            ->limit(10)
            ->latest();
            //->get();
//        $collection = collect([1,2,3]);
//        $collection[] = 11;
//        dump($collection);
        return view('site.index', compact('latestProducts'));

    }

    public function store(Request $request){
//        dd($request->session()->get('_token2', 'ssss'));
//    dd(session()->getId());
//        session()->put('test', '0000');
//        session()->push('test23', '1111111');
//        dump(session()->all());
        $products = Product::query()
            ->where('active', 1)
            ->limit(20)
            ->with('category')
            ->latest()
            ->get();
        $categories = Category::withCount('products')->get();
        return view('site.store', compact('products', 'categories'));
    }

    public function product(Request $request, $category_id, $product_id){
        $product = Product::where('active', 1)
            ->where('category_id', $category_id)
            ->where('id', $product_id)
            ->firstOrFail();
        return view('catalog.product', compact('product'));
    }
}
