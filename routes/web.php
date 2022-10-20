<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\studentController;
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
Route::get('/', [studentController::class, 'stdListing'])->name('stdListing');

Route::get('/add-student', [studentController::class, 'addPageView'])->name('addPageView');
Route::post('/storestudentdetails', [studentController::class, 'storestudentdetials'])->name('storeStudentDetails');
Route::get('/edit/{id}', [studentController::class, 'stdEdit'])->name('edit');
Route::get('/delete/{id}', [studentController::class, 'stdDelete'])->name('delete');
Route::post('/edit/store/{id}', [studentController::class, 'stdEditDataStore'])->name('stdEditDataStore');
