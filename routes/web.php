<?php

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

use App\Http\Controllers\DreamController;
use Illuminate\Support\Facades\Route;
// Route::get('/', function() {
//     return 'Hello World';
// });
Route::get('/','DreamController@index');
Route::get('/app/{slug}','DreamController@listPerGroup');
Route::get('/app/{group_slug}/{slug}/{cat?}','DreamController@listAlbumCategori');
Route::get('/member/{group_slug}/{vmember?}','DreamController@listMember');
Route::get('/detail/{photocard_id?}','DreamController@detailPhotocard');
Route::get('/clear/artisan', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return 'Application cache, route, config & view has been cleared';
});
Route::get('/clear/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/temp/cart', [DreamController::class, 'cart'])->name('cart');
Route::get('/tmp/add-to-cart/{id}', [DreamController::class, 'addToCart'])->name('add.to.cart');
Route::delete('/tmp/remove-from-cart', [DreamController::class, 'remove'])->name('remove.from.cart');
Route::delete('/tmp/remove-all-from-cart', [DreamController::class, 'removeall'])->name('remove.all.from.cart');

Route::get('/temp/cart-wtb', [DreamController::class, 'cartwtb'])->name('cartwtb');
Route::get('/tmp/add-to-cart-wtb/{id}', [DreamController::class, 'addToCartWtb'])->name('add.to.cart.wtb');

Route::get('/temp/cart-tr', [DreamController::class, 'carttr'])->name('carttr');
Route::get('/tmp/add-to-cart-trhave/{id}', [DreamController::class, 'addToCartTrhave'])->name('add.to.cart.trhave');
Route::get('/tmp/add-to-cart-trwant/{id}', [DreamController::class, 'addToCartTrwant'])->name('add.to.cart.trwant');


