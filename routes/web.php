<?php

Route::get('/', 'HomeController@index')->name('home');

Route::get('/registration', 'RegisterController@index')->name('registration.index');

Route::post('/registration', 'RegisterController@register')->name('registration.store');

Route::post('/user/check-username', 'UserController@checkUsername')->name('check.username');

