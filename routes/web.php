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
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
// Route::get('/', function() {
//     return 'Hello World';
// });
Route::get('/','DreamController@index');
Route::get('/app/{slug}','DreamController@listPerGroup');
//Route::get('/app/{group_slug}/{slug}/{cat?}','DreamController@listAlbumCategori');
Route::get('/app/{group_slug}/{slug}/{channel?}/{cat?}/{cek?}','DreamController@listAlbum');
Route::get('/member/{group_slug}/{vmember}/{cek?}','DreamController@listMember');
// Route::get('/detail/{photocard_id?}','DreamController@detailPhotocard');
Route::get('/clear/artisan', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return 'Application cache, route, config & view has been cleared';
});
Route::get('/clear/foo', function () {
    Artisan::call('storage:link');
});

Route::get('/temp/cart/{group?}/{album?}/{channel?}/{tipe?}', [DreamController::class, 'cart'])->name('cart');
Route::get('/tmp/add-to-cart/{id}', [DreamController::class, 'addToCart'])->name('add.to.cart');
Route::get('/tmp/add-all-to-cart/{id}', [DreamController::class, 'addAllChannelToCart'])->name('add.all.to.cart');
Route::delete('/tmp/remove-from-cart', [DreamController::class, 'remove'])->name('remove.from.cart');
Route::delete('/tmp/remove-all-from-cart', [DreamController::class, 'removeall'])->name('remove.all.from.cart');

Route::get('/temp/cart-wtb/{group?}/{album?}/{channel?}', [DreamController::class, 'cartwtb'])->name('cartwtb');
Route::get('/tmp/add-to-cart-wtb/{id}', [DreamController::class, 'addToCartWtb'])->name('add.to.cart.wtb');
Route::delete('/tmp/remove-from-cart-wtb', [DreamController::class, 'removewtb'])->name('remove.from.cart.wtb');
Route::delete('/tmp/remove-all-from-cart-wtb', [DreamController::class, 'removeallwtb'])->name('remove.all.from.cart.wtb');


Route::get('/temp/cart-tr', [DreamController::class, 'carttr'])->name('carttr');
Route::get('/tmp/add-to-cart-trhave/{id}', [DreamController::class, 'addToCartTrhave'])->name('add.to.cart.trhave');
Route::get('/tmp/add-to-cart-trwant/{id}', [DreamController::class, 'addToCartTrwant'])->name('add.to.cart.trwant');

Route::get('/search/{group_slug?}','DreamController@searchphotocard')->name('search');
Route::post('/search/upload/proses', 'DreamController@prosesUpload')->name('search.proses');

Route::get('/photocard/{group}/{album}/{photocard_id?}','DreamController@detailPhoca');
Route::get('/privacy-policy', function() {
    return view('dreamcard.privacy-policy');
});
Route::get('/terms-condition', function() {
    return view('dreamcard.term-condition');
});

//login page
Route::get('/login', function () {
    return view('dreamcard.login');
})->name('login');

// Untuk redirect ke Google
Route::get('/login/google/redirect', [SocialiteController::class, 'redirect'])
    ->middleware(['guest'])
    ->name('redirect');

// Untuk callback dari Google
Route::get('/login/google/callback', [SocialiteController::class, 'callback'])
    ->middleware(['guest'])
    ->name('callback');

// Untuk logout
Route::post('/logout', [SocialiteController::class, 'logout'])
    ->middleware(['auth'])
    ->name('logout');
