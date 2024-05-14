<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AssignmentFileController;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    $data['assignments'] = Assignment::orderBy('id', 'desc')->get();
    return view('welcome', $data);
});

Auth::routes(['register'=>false,'reset' => false]);



Route::middleware('auth')->group(function () {
    Route::resource('assignments', AssignmentController::class);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('assignmentFiles', AssignmentFileController::class)->except(['create', 'store', 'update', 'edit']);;
});
Route::post('/assignmentFiles', [AssignmentFileController::class, 'store'])->name('assignmentFiles.store');
