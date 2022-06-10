<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\LoginController;
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

Route::get('/login', [LoginController::class, 'show'])->name('login.show');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [EventsController::class, 'index']);
    Route::get('my-events', [EventsController::class, 'ownEvents']);
    Route::get('view-event/{id}', [EventsController::class, 'viewEvent']);
    Route::get('add-new-event', [EventsController::class, 'addNewEvent']);
    Route::post('add-new-event', [EventsController::class, 'postNewEvent']);
    Route::get('edit-event/{id}', [EventsController::class, 'editEvent']);
    Route::post('edit-event/{id}', [EventsController::class, 'postEditEvent']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout.perform');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index']);
    Route::post('update-event-status', [AdminController::class, 'changeEventApproval']);
    Route::get('view-event/{id}', [AdminController::class, 'viewEvent']);
});
