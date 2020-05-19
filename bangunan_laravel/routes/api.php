<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('jenises', 'JenisesApiController');

    Route::apiResource('satuans', 'SatuansApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    Route::post('barangs/media', 'BarangsApiController@storeMedia')->name('Barangs.storeMedia');
    Route::apiResource('barangs', 'BarangsApiController');

    // Galleries
    Route::post('galleries/media', 'GalleriesApiController@storeMedia')->name('galleries.storeMedia');
    Route::apiResource('galleries', 'GalleriesApiController');

});
