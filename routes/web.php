<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeedbackController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feedback1', function () {
    return view('feedback');
});

Route::post('/feedback1', [FeedbackController::class, 'storeFeedback1']);
Route::post('/feedback2', [FeedbackController::class, 'storeFeedback2']);

