<?php

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
    return view('welcome');
});

Route::get('/home', function () {
    return "Welcome to Home";
});

Route::redirect("/info", "/home");

Route::fallback(function () {
    return "404";
});

Route::view('/hello', 'hello', ['name' => "Raka"]);

Route::get('/hello-again', function () {
    return view('hello', ['name' => "Eko"]);
});

Route::get('/hello-world', function () {
    return view('hello.world', ['name' => "Raka"]);
});

// Route Parameter

Route::get('/products/{id}', function ($productId) {
    return "Products : " . $productId;
})->name('product.detail');

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return "Products : " . $productId . ", Items : " . $itemId;
})->name('product.item.detail');

Route::get('categories/{id}', function (string $categoryId) {
    return "Categories : " . $categoryId;
})->where('id', '[0-9]+')->name('category.detail');

// Optional Route Parameter

Route::get('users/{id?}', function (string $userId = '404') {
    return "Users : " . $userId;
})->name('user.detail');

// Menggunakan Named Route

Route::get('/produk/{id}', function ($id) {
    $link = route('product.detail', [
        'id' => $id
    ]);
    return "Link : " . $link;
});

Route::get('/produk-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', [
        'id' => $id
    ]);
});

// Route dengan Controller

Route::get('/controller/hello', [\App\Http\Controllers\HelloController::class, 'hello']);
Route::get('/controller/hello/{name}', [\App\Http\Controllers\HelloController::class, 'hello']);

// Route dengan Request Input

Route::get('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);
Route::post('/input/hello', [\App\Http\Controllers\InputController::class, 'hello']);

Route::post('/input/hello/first', [\App\Http\Controllers\InputController::class, 'helloFirst']);

Route::post('/input/hello/array', [\App\Http\Controllers\InputController::class, 'arrayInput']);

Route::post('/input/type', [\App\Http\Controllers\InputController::class, 'inputType']);

Route::post('/input/filter/only', [\App\Http\Controllers\InputController::class, 'filterOnly']);
Route::post('/input/filter/except', [\App\Http\Controllers\InputController::class, 'filterExcept']);

Route::post('/input/filter/merge', [\App\Http\Controllers\InputController::class, 'filterMerge']);

Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'upload'])
    ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

Route::get('/response/hello', [\App\Http\Controllers\ResponseController::class, 'response']);
Route::get('/response/header', [\App\Http\Controllers\ResponseController::class, 'header']);

Route::get('/response/type/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
Route::get('/response/type/json',  [\App\Http\Controllers\ResponseController::class, 'responseJson']);
Route::get('/response/type/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
Route::get('/response/type/download',  [\App\Http\Controllers\ResponseController::class, 'responseDownload']);

// Route Prefix
// Route::prefix('/response/type')->group(function(){
//     Route::get('/view', [\App\Http\Controllers\ResponseController::class, 'responseView']);
//     Route::get('/json',  [\App\Http\Controllers\ResponseController::class, 'responseJson']);
//     Route::get('/file', [\App\Http\Controllers\ResponseController::class, 'responseFile']);
//     Route::get('/download',  [\App\Http\Controllers\ResponseController::class, 'responseDownload']);
// });

// Cookie

Route::get('/cookie/set',  [\App\Http\Controllers\CookieController::class, 'createCookie']);
Route::get('/cookie/get',  [\App\Http\Controllers\CookieController::class, 'getCookie']);
Route::get('/cookie/clear',  [\App\Http\Controllers\CookieController::class, 'clearCookie']);

Route::controller(\App\Http\Controllers\CookieController::class)->group(function () {
    Route::get('/cookie/set', 'createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');
});


// Middleware Routes

Route::get('/middleware/api', function () {
    return "OK";
})->middleware([\App\Http\Middleware\SampleMiddleware::class]);

// Route::middleware(['sample'])->group(function(){
//     Route::get('/middleware/api', function(){
//         return "OK";
//     });
// });

Route::middleware(['sample'])->prefix('/middleware')->group(function () {
    Route::get('/api', function () {
        return "OK";
    });
});

// Form
Route::get('/form', [\App\Http\Controllers\FormController::class, 'form']);
Route::post('/form', [\App\Http\Controllers\FormController::class, 'submitform']);

// Current URL

Route::get('/url/current', function () {
    return \Illuminate\Support\Facades\URL::full();
});

// URL untuk Named Routes

Route::get('/redirect/name/{name}', [\App\Http\Controllers\RedirectController::class, 'redirectHello'])
    ->name('redirect-hello');

Route::get('/url/named', function () {
    return route('redirect-hello', ['name' => 'Eko']);
});


// URL Action

Route::get('/url/action', function () {
    return action([\App\Http\Controllers\FormController::class, 'form']);
});


// Session

Route::get('/session/create', [\App\Http\Controllers\SessionController::class, 'createSession']);
Route::get('/session/get', [\App\Http\Controllers\SessionController::class, 'getSession']);

// Error

Route::get('/error/sample', function () {
    throw new Exception("Sample Error");
});
Route::get('/error/manual', function () {
    report(new Exception("Sample Error"));
    return "OK";
});
Route::get('/error/validation', function () {
    throw new \App\Exceptions\ValidationException("Validation Error");
});

// HTTP EXCEPTION

Route::get('/abort/400', function () {
    abort(400);
});
Route::get('/abort/401', function () {
    abort(401);
});
Route::get('/abort/500', function () {
    abort(500);
});
