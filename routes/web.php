<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', 'UserController@getLogin')->name('login');
Route::post('/login', 'UserController@postLogin')->name('login.post');
Route::get('/logout', 'UserController@logout')->name('logout');

Route::prefix('admin')->group(function () {
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/profile', 'UserController@profile')->name('profile');
    Route::post('/profile', 'UserController@updateProfile')->name('profile.post');

    // Category
    Route::get('/categories', 'CategoryController@index')->name('category.index');
    Route::get('/categories/create', 'CategoryController@create')->name('category.create');
    Route::post('/categories', 'CategoryController@store')->name('category.store');
    Route::get('/categories/{id}/edit', 'CategoryController@edit')->name('category.edit');
    Route::put('/categories/{id}', 'CategoryController@update')->name('category.update');
    Route::delete('/categories/{id}', 'CategoryController@delete')->name('category.delete');

    // Post
    Route::get('/posts', 'PostController@index')->name('post.index');
    Route::get('/posts/create', 'PostController@create')->name('post.create');
    Route::post('/posts', 'PostController@store')->name('post.store');
    Route::get('/posts/{id}/edit', 'PostController@edit')->name('post.edit');
    Route::put('/posts/{id}', 'PostController@update')->name('post.update');
    Route::delete('/posts/{id}', 'PostController@delete')->name('post.delete');
    Route::post('/post-upload-file', 'PostController@upload_file')->name('post.upload_file');

    // Contact
    Route::get('/contact', 'ContactController@index')->name('contact.index');
    Route::delete('/contact/{id}', 'ContactController@delete')->name('contact.delete');

    // Setting
    Route::get('/setting', 'SettingController@index')->name('setting.index');
    Route::post('/setting', 'SettingController@store')->name('setting.store');

    // Clear cache
    Route::get('/clear-cache', 'SettingController@clearCache')->name('setting.clear_cache');
    Route::get('/clear-view', 'SettingController@clearView')->name('setting.clear_view');
    Route::get('/clear-route', 'SettingController@clearRoute')->name('setting.clear_route');
});

Route::get('/', 'HomeController@index')->name('home');

Route::get('/kien-thuc-trong-abc-tu', 'HomeController@knowledge')->name('knowledge');
Route::get('/kien-thuc-trong-abc-tu/{slug}', 'HomeController@knowledgeArticle')->name('knowledge.article');

Route::get('/chia-se', 'HomeController@sharing')->name('sharing');
Route::get('/chia-se/{slug}', 'HomeController@sharedArticle')->name('sharing.article');

Route::get('/category/{slug}', 'HomeController@category')->name('client.category');

Route::get('/lien-he', 'HomeController@contact')->name('contact');

Route::post('/dang-ky', 'HomeController@subscribe')->name('subscribe');