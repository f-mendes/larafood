<?php

Route::group([
    'prefix' => 'v1',
    'namespace' => 'Api'
], function (){
    Route::get('/tenant/{uuid}', 'TenantApiController@show');
    Route::get('/tenants', 'TenantApiController@index');

    Route::get('/categories/{url}', 'CategoryApiController@show');
    Route::get('/categories', 'CategoryApiController@categoriesByTenant');


    Route::get('/tables/{name}', 'TableApiController@show');
    Route::get('/tables', 'TableApiController@tablesByTenant');


    Route::get('/product/{url}', 'ProductApiController@show');
    Route::get('/products', 'ProductApiController@productsByTenant');

    Route::post('/client' , 'Auth\RegisterController@store');
    Route::post('/sanctum/token' , 'Auth\AuthClientController@auth');

});


Route::post('/sanctum/token' , 'Api\Auth\AuthClientController@auth');




Route::group([
    'middleware' => ['auth:sanctum']
], function (){

    Route::get('/auth/me' , 'Api\Auth\AuthClientController@me');
    Route::post('/auth/logout' , 'Api\Auth\AuthClientController@logout');
});