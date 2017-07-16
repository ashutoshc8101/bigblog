<?php

Route::get('/', 'homeController@index')->name('home');

Auth::routes();

Route::get('/write', 'newBlog@index')->name('newBlog')->middleware('auth');

Route::post('/write', 'newBlog@post')->name('newBlogPost')->middleware('auth');


/**
 * @Routes with paramaters starts below this
 */

Route::get('/ajax/tag/users', 'ajaxController@user');

Route::get('/ajax/tag/blogs', 'ajaxController@blog');

Route::get('/tag/{tagSlug}', 'tagController@index')->name('tag');

Route::get('/user/{id}', 'profileController@index')->name('user');

Route::get("/blog/comments/{slug}", "BlogController@comments");

/**
 * Do not put routes below this it will act like slug parameter
 */

Route::get('/{slug}', 'BlogController@blog')->name('blog');
