<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',                 'ApplicationController@index');
Route::get('/assessment',       'ApplicationController@assessment');
Route::get('/help',             'ApplicationController@help');
Route::get('/contact',          'ApplicationController@contact');

Route::get('/result',           'ResultController@people');
Route::get('/result/people',    'ResultController@people');
Route::get('/result/mail',      'ResultController@mail');
Route::get('/result/location',  'ResultController@location');
Route::get('/result/website',   'ResultController@website');


Route::get('/information/reset',                'InformationController@reset');
Route::post('/information/upload',              'InformationController@upload');
Route::post('/information/xing',                'InformationController@xing');
Route::post('/information/companyinformation',  'InformationController@companyInformation');