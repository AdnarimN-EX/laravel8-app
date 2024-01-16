<?php

use App\Http\Controllers\CitizensController;
use App\Http\Controllers\StatisticController;
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


Route::get('/', [CitizensController::class, 'index'])->name('citizens.index');
Route::get('/testing', [CitizensController::class, 'testing'])->name('citizens.testing');

Route::get('/citizens/create', [CitizensController::class, 'create'])->name('citizens.create');
Route::get('/report', [CitizensController::class, 'report'])->name('citizens.report');

Route::get('/statistics/gender', [StatisticController::class, 'genderStats'])->name('statistic.genderStats');
Route::get('/report/gender', [StatisticController::class, 'reportGender'])->name('statistic.reportGender');
Route::get('/statistics/sector', [StatisticController::class, 'sectorStats'])->name('statistic.sectorStats');
Route::get('/report/sector', [StatisticController::class, 'reportSector'])->name('statistic.reportSector');

//
Route::get('/testing', function(){
    return view('testing.testing');
});