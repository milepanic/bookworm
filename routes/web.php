<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'PagesController@landing')->name('landing');
Route::get('book-single/{book}', 'PagesController@singleBook')->name('singleBook');
Route::get('book-all', 'PagesController@allBooks')->name('allBooks');
Route::get('search', 'SearchController')->name('search');

Route::resource('books', 'BookController');


Route::resource('book', 'BookController');
