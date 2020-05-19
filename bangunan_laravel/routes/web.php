<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('speaker/{speaker}', 'HomeController@view')->name('speaker');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    Route::resource('jenises', 'JenisesController');

    Route::resource('barangm', 'BarangmController');

    Route::resource('barangk', 'BarangkController');

    Route::delete('satuans/destroy', 'SatuansController@massDestroy')->name('satuans.massDestroy');
    Route::resource('satuans', 'SatuansController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    Route::resource('invoices', 'InvoicesController');
    Route::delete('invoices/destroy', 'InvoicesController@massDestroy')->name('invoices.massDestroy');

    Route::delete('barangs/destroy', 'BarangsController@massDestroy')->name('barangs.massDestroy');
    Route::post('barangs/media', 'BarangsController@storeMedia')->name('barangs.storeMedia');
    Route::resource('barangs', 'BarangsController');

    // Galleries
    Route::delete('galleries/destroy', 'GalleriesController@massDestroy')->name('galleries.massDestroy');
    Route::post('galleries/media', 'GalleriesController@storeMedia')->name('galleries.storeMedia');
    Route::resource('galleries', 'GalleriesController');
});
