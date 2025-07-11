<?php

use App\Exceptions\ValidationException;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

use function PHPUnit\Framework\isNull;

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
    return view('welcome');
});

Route::get('/lbb', function () {
    return "Hello";
})->name('lbb.detail'); //menambahkan nama sebuah route agar mudah diakses 

Route::redirect('/redirect', '/lbb');

// Route::fallback(function () {
//     return '404 Web not found';
// });

Route::view('/hello', 'hello', ['name' => 'anto']); //menampilkan view. isi parameter (path,file,isi)
Route::get('/hello-again', function () {
    return view('hello', ['name' => 'again']);
}); //menampilkan view juga


Route::get('/hello-world', function () {
    return view('hello.world', ['name' => 'world']);
});

Route::get('/products/{id}', function ($productId) {
    return 'Product id : ' . $productId;
})->name('product.detail');

Route::get('/products/{id}/items/{itemId}', function ($productId, $itemId) {
    return "Product id : $productId, Item id : $itemId";
});

Route::get('/categories/{id}', function ($categoriesId) {
    return "Category : $categoriesId";
})->where('id', '[0-9]+')->name('category.detail'); //route dengan parameter regex

Route::get('/users/{id?}', function ($userId = null) { //membuat parameter menjadi opsional tetapi harus menambahkan
    if (is_null($userId)) {                             //default value nya dan {value?}
        return "User id is null";
    } else {
        return "User id : $userId";
    }
})->name('user.detail');


Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', [ //memanggil route dengan named route, 
        'id' => $id                     //route('_namedrout',['_paramnamedroute' => $paraminclosure])
    ]);
    return "Link $link";
});


Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});


Route::get('/controller/hello', [HelloController::class, 'hello']);
Route::get('/controller/hello/request', [HelloController::class, 'request']);
Route::get('/controller/hello/{name}', [HelloController::class, 'helloLangInd']);


Route::get('/controller/input', [InputController::class, 'hello']);
Route::post('/controller/input', [InputController::class, 'hello']);
Route::post('/controller/input/first', [InputController::class, 'helloFirstName']);
Route::post('/controller/input/get-all', [InputController::class, 'getAllInput']);
Route::post('/controller/input/type', [InputController::class, 'inputType']);
Route::post('/controller/input/filter/only', [InputController::class, 'inputFilterOnly']);
Route::post('/controller/input/filter/except', [InputController::class, 'inputFilterExcept']);
Route::post('/controller/input/filter/merge', [InputController::class, 'inputFilterMerge']);


Route::post('/file/upload', [FileController::class, 'upload'])
    ->withoutMiddleware([VerifyCsrfToken::class]); //meng exclude middleware yang tidak dibutuhkan


Route::prefix("/response")->group(function () { //jika memiliki awalan path yang sama bisa di group
    Route::get('/hello', [ResponseController::class, 'response']);
    Route::get('/header', [ResponseController::class, 'header']);
    Route::get('/view', [ResponseController::class, 'responseView']);
    Route::get('/json', [ResponseController::class, 'responseJson']);
    Route::get('/file', [ResponseController::class, 'responseFile']);
    Route::get('/download', [ResponseController::class, 'responseDownload']);
}); // disebut Prefix / awalan

Route::controller(CookieController::class)->group(function () {
    Route::get('/cookie', 'createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');
}); //group jika memiliki class controller yang sama 


Route::get('/redirect/from', [RedirectController::class, 'redirectFrom']);
Route::get('/redirect/to', [RedirectController::class, 'redirectTo']);
Route::get('/redirect/name', [RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [RedirectController::class, 'redirectHello'])
    ->name("redirect-hello");
Route::get('/redirect/action', [RedirectController::class, 'redirectAction']);

Route::get("redirect/away", [RedirectController::class, "redirectAway"]);

Route::middleware(['contoh.middleware:KEY,401'])->prefix("/middleware")->group(function () {
    Route::get("/api", function () {
        return "OK!";
    });
    Route::get("/group", function () {
        return "Group!";
    });
});



Route::controller(FormController::class)->group(function () {
    Route::get("/form",  "form");
    Route::post("/form",  "submitForm");
});

Route::get("/url/current", function () {
    return URL::full();
});

Route::get("/session/create", [SessionController::class, 'createSession']);
Route::get("/session/get", [SessionController::class, "getSession"]);


Route::get("/error/sample", function () {
    throw new Exception("Sample Error");
});


Route::get("/error/manual", function () {
    report(new Exception("sample error")); //akan mentrigger reportable di class handler
    return "ok";
});
Route::get("/error/validation", function () {
    throw new ValidationException("Validation error");
});
