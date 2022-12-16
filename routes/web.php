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

use Illuminate\Support\Facades\Route;
// Route::get('/', function() {
//     return 'Hello World';
// });
Route::get('/','DreamController@index');
Route::get('/app/{slug}','DreamController@listPerGroup');
Route::get('/app/{group_slug}/{slug}/{cat?}','DreamController@listAlbumCategori');
Route::get('/member/{group_slug}/{vmember?}','DreamController@listMember');
Route::get('/clear/artisan', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return 'Application cache, route, config & view has been cleared';
});
Route::get('/clear/foo', function () {
    Artisan::call('storage:link');
});

