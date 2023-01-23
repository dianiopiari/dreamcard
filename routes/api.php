<?php

use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\TestController;
use App\Http\Controllers\API\DreamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


# ============================= Unuthenticated Route ===================================
Route::group([
    'namespace'  => 'api',
    'middleware' => []
], 
function (Router $router) {    
    $router->get('/test/api-keys', function (Request $request) {
        $api_key = ApiKey::where(['active' => 1, 'deleted_at' => null])->get();
        return [
            'Headers'   => 'X-Authorization',
            'data'      => $api_key,
        ];
    });  
});


# =========================== GROUP NO AUTH SANCTUM ===============================
Route::group([
    'namespace'  => 'api', 
    'middleware' => ['auth.apikey']
], 
function (Router $router) { 
    $router->get('testing-work', [TestController::class, 'index'])->name('test.index');
    $router->post('register', [AuthController::class, 'register'])->name('auth.register');
});


# =========================== GROUP AUTH SANCTUM ===============================
Route::group([
    'namespace'  => 'api', 
    'middleware' => ['auth.apikey', 'auth:sanctum']
], 
function (Router $router) { 
    $router->get('home', [HomeController::class, 'index'])->name('home.index');
    $router->get('group/{slug}', [DreamController::class, 'listPerGroup'])->name('group.detail');
    $router->post('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

