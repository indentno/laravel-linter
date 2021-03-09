<?php

Route::get(
    '/',
    [
        'as' => 'page.index',
        'uses' => 'PageController@index',
    ]
);

Route::group(['prefix' => 'user'], function () {
    Route::get(
        '/',
        [
            'as' => 'user.index',
            'uses' => 'UserController@index',
        ]
    );
});
