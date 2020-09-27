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

/****** Company Routes *******/

Route::get('/company/{id?}', function ($id = '') {
    return view('layouts.app', ['component' => "<company company_id='$id' />"]);
})->name('company');

Route::get('/show-companies', function () {
    return view('layouts.app', ['component' => '<companies-datatable/>']);
})->name('show_companies');

Route::post('/save-company', 'CompanyController@save');
Route::get('/get-companies', 'CompanyController@getCompanies');
Route::post('/delete-company', 'CompanyController@delete');
Route::get('/get-company/{id?}', 'CompanyController@getCompany');

/****** Employee Routes *******/

Route::get('/employee', function () {
    return view('layouts.app', ['component' => '<employee/>']);
})->name('employee');

Route::get('/show-employees', function () {
    return view('layouts.app', ['component' => '<employees-datatable/>']);
})->name('show_employees');


Route::post('/save-employee', 'EmployeeController@save');
Route::get('/get-employees', 'EmployeeController@getEmployees');
Route::post('/delete-employee', 'EmployeeController@delete');
