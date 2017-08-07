<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


/*
 * ADMIN END ROUTES
 */

Route::get('admin/dealer', 'Admin\HomeController@index');

Route::get('admin/dealer/add-article', 'Admin\AddArticleController@indexCreate');
Route::get('admin/dealer/edit-article/{id}', 'Admin\AddArticleController@indexUpdate');


Route::post('admin/dealer/add-article/create', 'Clanky\ClankyController@create');
Route::patch('admin/dealer/update-article/{article}', 'Clanky\ClankyController@update');
Route::get('admin/dealer/delete-article/{article}', 'Clanky\ClankyController@delete');
Route::patch('admin/dealer/add-article/storyline/{storyline}', 'Admin\AddArticleController@storyline');

Route::get('admin/dealer/list-of-articles', 'Admin\AddArticleController@listOfArticles');

Route::get('admin/dealer/list-of-galleries', 'Admin\AdminGalleryController@index');
Route::get('admin/dealer/add-gallery', 'Admin\AdminGalleryController@editGallery');
Route::post('admin/dealer/add-gallery', 'Admin\AdminGalleryController@addPicture');
Route::get('admin/dealer/delete-gallery/{id}', 'Admin\AdminGalleryController@deleteGallery');

Route::get('admin/dealer/account-settings', 'Admin\HomeController@admin');
Route::get('admin/dealer/logout', 'Admin\HomeController@logout');


/*
 * AUTHENTICATION ROUTES
 */

Auth::routes();
Route::get('admin', 'Admin\HomeController@index');


/*
 * PUBLIC END ROUTES
 */

Route::get('/', 'Home\HomeController@index');
Route::get('clanek/{article}', 'Clanky\ClankyController@show');
Route::get('clanky', 'Clanky\ClankyController@index');
Route::get('clanky/mesic/{mesic}', 'Clanky\ClankyController@index');
Route::get('manifest', 'Manifest\ManifestController@index');
Route::get('literarni-tour', 'LiterarniTour\LiterarniTourController@index');
Route::get('literarni-tour/{id}', 'LiterarniTour\LiterarniTourController@show');
Route::get('galerie', 'Gallery\GalleryController@index');
Route::get('galerie-prohlidka/{id}', 'Gallery\GalleryController@show');

