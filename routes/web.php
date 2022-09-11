<?php

use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $category = Category::all();
    dump($category);
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class,'index'])->name('home');

Route::prefix('admin')->group(function(){


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
