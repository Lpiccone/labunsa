<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/analysis', function () {
    return view('analysis');
});
Route::get('/category', function () {
    return view('category');
});
Route::get('/detail', function () {
    return view('detail');
});
Route::get('/headboards', function () {
    return view('headboards');
});
Route::get('/parameter', function () {
    return view('parameter');
});
Route::get('/patient', function () {
    return view('patient');
});
Route::get('/referencia', function () {
    return view('referencia');
});
Route::get('/resultado', function () {
    return view('resultado');
});
Route::get('/solicitud', function () {
    return view('solicitud');
});
Route::get('/in', function () {
    return view('in');
});
Route::get('/out', function () {
    return view('out');
});
Route::get('/reactives', function () {
    return view('reactives');
});
Route::get('/nuevo2', function () {
    return view('nuevo2');
});

Route::post('/analysis/store', 'AnalysisController@store');
Route::get('/analysis/index', 'AnalysisController@index');
Route::put('/analysis/update', 'AnalysisController@update');
Route::delete('/analysis/destroy/{id}', 'AnalysisController@destroy');
Route::get('/analysisget', 'AnalysisController@getAnalysis');
Route::get('categories', 'AnalysisController@getCategory');


Route::post('/category/store', 'CategoryController@store');
Route::get('/category/index', 'CategoryController@index');
Route::put('/category/update', 'CategoryController@update');
Route::delete('/category/destroy/{id}', 'CategoryController@destroy');

Route::post('/details/store', 'DetailsController@store');
Route::get('/details/index', 'DetailsController@index');
Route::put('/details/update', 'DetailsController@update');
Route::delete('/details/destroy/{id}', 'DetailsController@destroy');

Route::post('/headboards/store', 'HeadboardsController@store');
Route::get('/headboards/index', 'HeadboardsController@index');
Route::put('/headboards/update', 'HeadboardsController@update');
Route::delete('/headboards/destroy/{id}', 'HeadboardsController@destroy');
Route::get('referenciasget', 'HeadboardsController@getReferencias');
Route::get('patientsget', 'HeadboardsController@getPatients');
Route::get('analysisget', 'HeadboardsController@getAnalysis');
Route::get('/ficha/cargarPdfHeadboards', 'HeadboardsController@cargarPdfHeadboards');

Route::post('/in/store', 'In_ReactivesController@store');
Route::get('/in/index', 'In_ReactivesController@index');
Route::put('/in/update', 'In_ReactivesController@update');
Route::delete('/in/destroy/{id}', 'In_ReactivesController@destroy');
Route::get('reactivesget', 'In_ReactivesController@getReactives');

Route::post('/out/store', 'Out_ReactivesController@store');
Route::get('/out/index', 'Out_ReactivesController@index');
Route::put('/out/update', 'Out_ReactivesController@update');
Route::delete('/out/destroy/{id}', 'Out_ReactivesController@destroy');

Route::post('/parameter/store', 'ParameterController@store');
Route::get('/parameter/index', 'ParameterController@index');
Route::put('/parameter/update', 'ParameterController@update');
Route::delete('/headboards/destroy/{id}', 'ParameterController@destroy');

Route::post('/patient/store', 'PatientController@store');
Route::get('/patient/index', 'PatientController@index');
Route::put('/patient/update', 'PatientController@update');
Route::get('/patient/selectPatient', 'PatientController@selectPatient');
Route::delete('/patient/destroy/{id}', 'PatientController@destroy');

Route::post('/reactives/store', 'ReactivesController@store');
Route::get('/reactives/index', 'ReactivesController@index');
Route::put('/reactives/update', 'ReactivesController@update');
Route::delete('/reactives/destroy/{id}', 'ReactivesController@destroy');


Route::post('/referencia/store', 'ReferenciaController@store');
Route::get('/referencia/index', 'ReferenciaController@index');
Route::put('/referencia/update', 'ReferenciaController@update');
Route::delete('/referencia/destroy/{id}', 'ReferenciaController@destroy');

Route::post('/result/store', 'ResultController@store');
Route::get('/result/index', 'ResultController@index');
Route::put('/result/update', 'ResultController@update');
Route::delete('/result/destroy/{id}', 'ResultController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
