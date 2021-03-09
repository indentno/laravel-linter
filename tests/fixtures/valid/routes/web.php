<?php

use Admin\Http\Controllers\PageController;

Route::get('/', 'PageController@index')->name('page.index');
Route::get('{page}', [PageController::class, 'show'])->name('page.show');

Route::group(['prefix' => 'user'], function () {
    Route::get('/', 'UserController@index')->name('user.index');
});
