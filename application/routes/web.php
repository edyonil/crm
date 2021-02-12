<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\LiveWire\Company;
use App\Http\LiveWire\CompanyView;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');

})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get("/company", Company::class)->name('company');
    Route::get("/company/{company}", CompanyView::class)->name('company-view');
    //Route::get("/company/{company}/edit", FormAdd::class)->name('company-edit');
    //Route::get("company/add", FormAdd::class)->name('company-add');
});
