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
Route::get('/test-sql', function() {
    //DB::enableQueryLog();
    //$articles = App\Article::create();
    //return response()->json(DB::getQueryLog());
});

Route::get('/','ArticlesController@index');
//Route::get('/about','SitesController@about');
// 图片上传
Route::post('/upfile','SitesController@upload');
//Route::get('/contact','SitesController@contact');

//Route::get('admin', function () {
//	return view('admin_template');
//});


// 搜索路由
Route::get('/articles/search','ArticlesController@search');
// 数据备份路由
Route::get('/articles/backup','ArticlesController@backup');
Route::get('/articles/create','ArticlesController@create');
Route::get('/articles/{id}','ArticlesController@show');
Route::post('/articles','ArticlesController@store');
Route::get('/articles/{id}/edit','ArticlesController@edit');
Route::get('/articles','ArticlesController@index');


// 标签列表页
Route::get('/articles/tag/{id}','ArticlesController@tagList');
// 留言路由
Route::get('/articles/message/list', 'Article\LeaveMessageController@index');
Route::get('/articles/message/create','Article\LeaveMessageController@create');
Route::post('/articles/message','Article\LeaveMessageController@store');
Route::get('/articles/test', function(){
    return [123];
});

// Route::resource('/articles/message','\App\Http\Controllers\Article\LeaveMessageController');

//Route::get('/articles/testmessage',function(){
//    return view('articles.messageOld');
//});

// 文章的新增和展示等等
Route::match(['get'],'/','ArticlesController@index')->name('main');
Route::match(['get'],'/articles/{id}','ArticlesController@show')->name('articles_id');
Route::match(['get'],'/articles/{id}/edit','ArticlesController@edit')->name('articles_edit');
Route::match(['get'],'/articles/edit/{id}','ArticlesController@edit')->name('articles_edit_id');

Route::resource('articles','ArticlesController');

Route::get('auth/login','Auth\AuthController@getLogin');
Route::post('auth/login','Auth\AuthController@selfPostLogin');

Route::get('auth/register','Auth\AuthController@getRegister');
Route::post('auth/register','Auth\AuthController@postRegister');

Route::get('auth/logout','Auth\AuthController@getLogout');


// API 路由配置
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->post('user/login','AuthController@authenticate');
        $api->get('/test/articles','ArticleController@index');
    });
});

Route::get('/test/test1', function(){

    return view('test.wildDog');
});

Route::resource('/admin', '\App\Http\Controllers\Article\AdminController');
