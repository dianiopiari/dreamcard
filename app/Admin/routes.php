<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    //test
    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('m-albums', AlbumController::class);
    $router->resource('m-channels', ChannelController::class);
    $router->resource('m-groups', GroupController::class);
    $router->resource('m-photocards', PhotocardController::class);
    $router->resource('m-members', MemberController::class);
    $router->resource('t-photocards', TPhotocardController::class);
});
