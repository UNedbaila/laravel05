<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\SiteController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', SiteController::class);
Route::get('/catalog', CatalogController::class);

Route::get('/cart',[ CartController::class, 'getCart']);
Route::get('/add_to_cart', [CartController::class, 'addToCart']);
Route::get('/test', function(){
    //$product = Product::inRandomOrder()->first();
    //$category = Category::findOrFail($product->category_id);
    //$category = Category::inRandomOrder()->first();
    $category = Category::find(1);
    dd($category->products()->where('active', 1));
     });






Route::get('/any_file', function (){
    return Storage::download('1.txt');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class,'index'])->name('home');

Route::middleware('auth')->prefix('admin')->group(function(){


Route::get('/',[App\Http\Controllers\Admin\MyController::class,'index']);
//Route::resource('categories',CategoryController::class)->except(['show']);  //except удаление метода
Route::resources([
    'categories' => CategoryController::class,
    'products' => ProductController::class,
    'articles' => ArticleController::class
]);


//Route::get('/categories',[CategoryController::class, 'index'])
//    ->name('categories.index');
//Route::get('/categories/create',[CategoryController::class, 'create'])
//    ->name('categories.create');
//Route::post('/categories/create',[CategoryController::class, 'store'])
//    ->name('categories.store');
//Route::get('/categories/{category}/edit',[CategoryController::class, 'edit'])
//    ->name('categories.edit');
//Route::put('/categories/{category}/update',[CategoryController::class, 'update'])
//    ->name('categories.update');
//Route::delete('/categories/{category}/delete',[CategoryController::class, 'delete'])
//    ->name('categories.delete');

});
