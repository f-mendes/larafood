<?php

Route::get('/tenant/{uuid}', 'Api\TenantApiController@show');
Route::get('/tenants', 'Api\TenantApiController@index');

Route::get('/categories/{url}', 'Api\CategoryApiController@show');
Route::get('/categories', 'Api\CategoryApiController@categoriesByTenant');


Route::get('/tables/{name}', 'Api\TableApiController@show');
Route::get('/tables', 'Api\TableApiController@tablesByTenant');