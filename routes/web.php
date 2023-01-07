<?php

Route::prefix('admin')->namespace('Admin')->middleware('auth')->group(function(){


    Route::get('teste_acl', function () {
        dd(auth()->user()->permissions());
    });

    //Tables
    Route::resource('tables', 'TableController');
    Route::any('tables/search', 'TableController@search')->name('tables.search');

    //Permissions x Profiles
    Route::get('products/{id}/category/{idPCategory}', 'ProductCategoryController@detachCategoryProduct')->name('products.categories.detach');
    Route::post('products/{id}/categories', 'ProductCategoryController@attachCategoryProduct')->name('products.categories.attach');
    Route::any('products/{id}/categories/create', 'ProductCategoryController@categoriesAvailable')->name('products.categories.available');
    Route::get('products/{id}/categories', 'ProductCategoryController@categories')->name('products.categories');


    //Product
    Route::resource('products', 'ProductController');
    Route::any('products/search', 'ProductController@search')->name('products.search');
    Route::get('/', 'ProductController@index')->name('admin.index');

    //Category
    Route::resource('categories', 'CategoryController');
    Route::any('categories/search', 'CategoryController@search')->name('categories.search');


    //Users
    Route::resource('users', 'UserController');
    Route::any('users/search', 'UserController@search')->name('users.search');

    //Plans x Profiles
    Route::get('profiles/{id}/plan/{idPlan}', 'ACL\PlanProfileController@detachPlanProfile')->name('profiles.plans.detach');
    Route::post('profiles/{id}/plans', 'ACL\PlanProfileController@attachPlansProfile')->name('profiles.plans.attach');
    Route::any('profiles/{id}/plans/create', 'ACL\PlanProfileController@plansAvailable')->name('profiles.plans.available');
    Route::get('profiles/{id}/plans', 'ACL\PlanProfileController@plans')->name('profiles.plans');

      
    //Permissions x Profiles
    Route::get('profiles/{id}/permission/{idPermission}', 'ACL\PermissionProfileController@detachPermissionProfile')->name('profiles.permissions.detach');
    Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
    Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
    Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');

    //Permissions
    Route::resource('permissions', 'ACL\PermissionController');
    Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');

    //Profiles
    Route::resource('profiles', 'ACL\ProfileController');
    Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    //Plans
    Route::delete('plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
    Route::get('plans/{url}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show');
    Route::put('plans/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');
    Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
    Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');


    Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
    Route::get('plans/create', 'PlanController@create')->name('plans.create');
    Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
    Route::post('plans', 'PlanController@store')->name('plans.store');
    Route::get('plans', 'PlanController@index')->name('plans.index');
    


    
});


Route::get('/', 'Site\SiteController@index')->name('site.home');
Route::get('plan/{url}', 'Site\SiteController@plan')->name('site.plan.subscription');

/**
 * Auth Routes
 */
Auth::routes();