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

});
