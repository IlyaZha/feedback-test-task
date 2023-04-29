<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\FeedbackController;

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

Route::get('/',  FeedbackController::class . '@index')->name('feedback.index');
Route::post('/feedback', FeedbackController::class . '@store')->name('feedback.store');
Route::get('/feedback-list', FeedbackController::class . '@list')->name('feedback.list');

