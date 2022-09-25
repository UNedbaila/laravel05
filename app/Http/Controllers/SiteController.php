<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function __invoke()
    {
        //select * from products
        //where active = 1 and category_id = 1
        //limit 10
        //order by id desc
        $latestProducts = Product::query()
            ->where('active',1)
            ->limit(10)
            ->latest()
            ->get();
        //dd($latestProducts->toArray());
//        $latestProducts = $latestProducts->keyBy('id');
//        $latestProducts = $latestProducts->toArray();
//        dd($latestProducts);


        return view('site.index',compact('latestProducts'));
    }
}
