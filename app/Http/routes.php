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




//Route::post('send', ['as' => 'send', 'uses' => 'MailController@send'] );
//Route::get('contact', ['as' => 'contact', 'uses' => 'MailController@index'] );
//-----------------------------------

//Route::post('send', ['as' => 'send', 'uses' => 'detalleRevisionController@send'] );
Route::get('eliminarVarios','detalleRevisionController@delete');
Route::post('send', ['as' => 'send', 'uses' => 'detalleRevisionController@send'] );
Route::get('index', ['as' => 'index', 'uses' => 'detalleRevisionController@index'] );



Route::get('deleteProyectos', ['as' => 'deleteProyectos', 'uses' => 'proyectoController@delete'] );
Route::get('deleteFormatoLista', ['as' => 'deleteFormatoLista', 'uses' => 'formatolistaController@delete'] );
Route::get('deleteFormatoLegalizacion', ['as' => 'deleteFormatoLegalizacion', 'uses' => 'FormatoLegalizacionController@delete'] );
Route::get('deleteDatosGenerales', ['as' => 'deleteDatosGenerales', 'uses' => 'datosGeneralesController@delete'] );
Route::get('deleteRevison', ['as' => 'deleteRevison', 'uses' => 'revisionController@delete'] );
Route::get('deleteRevisonDetalle', ['as' => 'deleteRevisonDetalle', 'uses' => 'detalleRevisionController@delete'] );



//-------------------------------------
Route::get('/', 'detalleRevisionController@correo');
Route::get('formato','revisionController@formato_lista');

Route::get('legal','revisionController@formato_legalizacion');




Route::get('/', 'HomeController@index');

Route::get('app', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


Route::resource('proyectos', 'proyectoController');

Route::get('proyectos/{id}/delete', [
    'as' => 'proyectos.delete',
    'uses' => 'proyectoController@destroy',
]);


Route::resource('formatolistas', 'formatolistaController');

Route::get('formatolistas/{id}/delete', [
    'as' => 'formatolistas.delete',
    'uses' => 'formatolistaController@destroy',

]);


Route::resource('datosGenerales', 'datosGeneralesController');

Route::get('datosGenerales/{id}/delete', [
    'as' => 'datosGenerales.delete',
    'uses' => 'datosGeneralesController@destroy',
]);


Route::resource('formatoLegalizacions', 'FormatoLegalizacionController');

Route::get('formatoLegalizacions/{id}/delete', [
    'as' => 'formatoLegalizacions.delete',
    'uses' => 'FormatoLegalizacionController@destroy',
]);


Route::resource('chequeos', 'chequeoController');

Route::get('chequeos/{id}/delete', [
    'as' => 'chequeos.delete',
    'uses' => 'chequeoController@destroy',
]);




Route::resource('datosGenerales', 'datosGeneralesController');

Route::get('datosGenerales/{id}/delete', [
    'as' => 'datosGenerales.delete',
    'uses' => 'datosGeneralesController@destroy',
]);


Route::resource('revisions', 'revisionController');

Route::get('revisions/{id}/delete', [
    'as' => 'revisions.delete',
    'uses' => 'revisionController@destroy',
]);


Route::resource('detalleRevisions', 'detalleRevisionController');

Route::get('detalleRevisions/{id}/delete', [
    'as' => 'detalleRevisions.delete',
    'uses' => 'detalleRevisionController@destroy',
]);

Route::resource('proyectoExcel','ExcelController');

Route::get('formatoExcel','ExcelController@formato');

Route::get('chequeosExcel','ExcelController@chequeos');

Route::get('revisionExcel','ExcelController@revision');

Route::get('detalleExcel','ExcelController@detalle');
















