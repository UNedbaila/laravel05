
Route::get('/store', [SiteController::class, 'store']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware('auth')->prefix('admin')->group(callback: function () {

    Route::get('/', [MyController::class, 'index'])->name('')->withoutMiddleware('auth');

    Route::resources([
        'categories' => CategoryController::class,
        'products' => ProductController::class,
        'articles' => ArticleController::class,
    ]);
});
