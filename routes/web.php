<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\VtController;
use App\Mail\FirstMail;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MyController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ArticleController;
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
Route::get('catalog/{category_id}/{product_id}', [CatalogController::class, 'product'])->name('site.product');
Route::get('/cart', [CartController::class, 'getCart'])->name('cart');
Route::post('/add_to_cart', [CartController::class, 'addToCart'])->name('add_to_cart');
Route::get('/info', InfoController::class);

Route::get('/convert', function (Request $request){
    $response = Http::get('https://www.nbrb.by/api/exrates/currencies');
    $currencies = $response->collect()->KeyBy('Cur_Abbreviation');
    return view('convert', compact('currencies'));
});

Route::post('/convert', function (Request $request){
    $query = [
        'periodicity' => 0
    ];
    $response = Http::get('https://www.nbrb.by/api/exrates/currencies', $query);
    dd($response->collect()->KeyBy('Cur_Abbreviation'));
});

Route::get('/weather', function (Request $request){
    $query = [
        'key' => env('WEATHER_API_KEY'),
        'q' => 'Minsk',
        'dt' => '1989-08-31'

    ];

    $client = Http::baseUrl('http://api.weatherapi.com/v1');
    $response = $client->get('/current.json', $query);
    $result = $response['current']['temp_c'].'C'.' '.$response['location']['region']. $query['dt'];
    dd($result);
    //return view('weather', compact('response'));
});

Route::get('/gif', function (Request $request){
    $query = [
        'api_key' => env('GIPHY_API_KEY'),
        'limit' => '25',
        'rating' => 'g'

    ];

    $response = Http::get('api.giphy.com/v1/gifs/trending',$query);

    foreach ($response->collect()['data'] as $gif){
        echo "<img src='{$gif['url']}' width='250' />";
    }
    //return view('weather', compact('response'));
});

Route::get('/evil', function (Request $request){
    $query = [

        'lang' => 'ru',
        'type' => 'json'

    ];

    $response = Http::get('https://evilinsult.com/generate_insult.php',$query);

    dd($response->json());
    //return view('weather', compact('response'));
});

Route::get('/mail', function (Request $request){

//
//    $job = new \App\Jobs\FirstJob('Volodija!!!');
//    $job->dispatch('Volodija!!!');
//    \App\Jobs\FirstJob::dispatch('Volodija!!!');

//    \App\Jobs\FirstJob::dispatch('Volodija!!!') ->onQueue('2myEmails');
//      \App\Jobs\FirstJob::dispatchAfterResponse('Volodija!!!'); //???????????? ???????????????????? ?????????? ???????????? ????????????????????????

     $mail = new FirstMail('Hi! JACK!');
        Mail::send($mail);

    //Mail::send($mail);
    //return view('mail', compact('mail'));
});




Route::get('/test', function (Request $request) {

    $query = [
        'ondate' => '2016-7-1',
        'periodicity' => '1'
    ];
    $client = new Client([
        'base_uri' => 'https://www.nbrb.by/api/'
    ]);
//    $response = $client->get( 'exrates/rates/145', [
//         'query' => $query
//        ]
//    );
   $response =Http::get('https://www.nbrb.by/api/exrates/rates/145?ondate=2016-7-1&periodicity=1');
    dd($response->json());
//    $response = $client->get( 'exrates/rates', [
//            'query' => $query
//        ]
//    );
//    dd(json_decode($response->getBody()->getContents(), true));
});

Route::get('/omdb', function (Request $request){

    $query = [
        'apikey' => env('OMDB_API_KEY'),
        't' => 'Die Hard'

    ];

    $responce = Http::get('http://www.omdbapi.com/', $query);
    $film = [$responce->json()];
    //dd($film);
    return view('omdb', compact('film'));

});







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
