<?php

Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('roles', 'RolesApiController');

    Route::apiResource('users', 'UsersApiController');

    Route::apiResource('products', 'ProductsApiController');
});

Route::get('/webhook', 'WhatsAppController@webhook')->name('woowa.webhook');
Route::get('/check-resi', 'WhatsAppController@checkResi')->name('woowa.check_resi');
