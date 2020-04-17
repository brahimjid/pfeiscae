<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'PagesController@index')->name('indexPages');

    Auth::routes();
    Auth::routes(['verify' => true]);
    Route::prefix('medecin')->group(function (){
    Route::get('/login', 'Auth\MedecinLoginController@showLoginForm')->name('medecin-login');
    Route::post('/login', 'Auth\MedecinLoginController@login')->name('medecin-submit-login');

    Route::get('/register', 'Auth\MedecinRegisterController@showRegisterForm')->name('medecin-registerForm');
    Route::post('/register', 'Auth\MedecinRegisterController@register')->name('medecin-register');
    Route::get('/', 'MedecinsHomeController@index')->name('medecinIndex');
});

    Route::prefix('structure')->group(function (){
    Route::get('/login', 'Auth\StructureLoginController@showLoginForm')->name('structure-login');
    Route::post('/login', 'Auth\StructureLoginController@login')->name('structure-submit-login');

    Route::get('/register', 'Auth\StructureRegisterController@showRegisterForm')->name('structure-registerForm');
    Route::post('/register', 'Auth\StructureRegisterController@register')->name('structure-register');
    Route::get('/', 'StructuresHomeController@index')->name('structureIndex');
});
    Route::prefix('admin')->group(function (){
    Route::get('/login', 'Auth\SuperAdminLoginController@showLoginForm')->name('admin-login');
    Route::post('/login', 'Auth\SuperAdminLoginController@login')->name('admin-submit-login');

    Route::get('/register', 'Auth\SuperAdminRegisterController@showRegisterForm')->name('admin-registerForm');
    Route::post('/register', 'Auth\SuperAdminRegisterController@register')->name('admin-register');
    Route::get('/', 'SuperAdminHomeController@index')->name('adminIndex');
});
    Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

        // plannings
Route::get('/plannings/medecins','PlanningsController@medecinsList')->name('listMedecins');
Route::get('/plannings/medecin/{id}/specialite','PlanningsController@medecinSpec')->name('medecinSpec');
  Route::resource('/plannings','PlanningsController');
