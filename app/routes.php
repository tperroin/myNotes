<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'LoginController@showLogin'));
Route::get('/login', array('uses' => 'LoginController@showLogin'));
Route::post('login', array('uses' => 'LoginController@doLogin'));
Route::get('logout', array('uses' => 'LoginController@doLogout'));

Route::get('home', array('uses' => 'HomeController@showWelcome'));

Route::resource('sessions', 'SessionController');

/*
|--------------------------------------------------------------------------
| Admin routes
|--------------------------------------------------------------------------
|
| Rest routes for admin.
|
*/

Route::group(array('before'=>'isAdmin', 'prefix' => 'admin'), function() {
    Route::get('/', function () {
        return View::make('admin/index');
    });
    Route::get('students/{id}/create/user', 'UserController@createStudent');
    Route::post('students/store/user', 'UserController@storeStudent');
    Route::get('formateurs/{id}/create/user', 'UserController@createFormateur');
    Route::post('formateurs/store/user', 'UserController@storeFormateur');

    Route::resource('users', 'UserController');
    Route::resource('curriculums', 'CurriculumController');
    Route::resource('classrooms', 'ClassroomController');
    Route::resource('students', 'StudentController');
    Route::resource('formateurs', 'FormateurController');
    Route::resource('courses', 'CoursController');

    /**
     * Filtres
     */
    Route::post('formateurs/filter', 'Formateurcontroller@filter');
    Route::post('users/filter', 'Usercontroller@filter');
    Route::post('students/filter', 'StudentController@filter');
    Route::post('curriculums/filter', 'CurriculumController@filter');
    Route::post('classrooms/filter', 'ClassroomController@filter');
});
