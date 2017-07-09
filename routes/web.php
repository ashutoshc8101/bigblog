<?php

Route::get('/', 'homeController@index')->name('home');

Route::get('/test', function(){


});

Auth::routes();


Route::get('/write', 'newBlog@index')->name('newBlog')->middleware('auth');

Route::post('/write', 'newBlog@post')->name('post')->middleware('auth');


/*
 * @Routes with paramaters starts below this
 */

Route::get('/ajax/tag/users', 'ajaxController@user');

Route::get('/ajax/tag/blogs', 'ajaxController@blog');

Route::get('/tag/{tagSlug}', 'tagController@index')->name('tag');

Route::get('/user/{id}', 'profileController@index')->name('user');

/**
 * Do not put routes below this it will act like slug parameter
 */

Route::get('/{slug}', 'HomeController@blog')->name('blog');
