<?php

use App\Http\Controllers\Api\RegisterConfirmationController;
use App\Http\Controllers\Api\UserAvatarController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\BestRepliesController;
use App\Http\Controllers\LockedThreadsController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserNotificationsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\ThreadsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\ThreadSubscriptionsController;

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

Auth::routes();

Route::view('/scan', 'scan');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/threads/search', [SearchController::class, 'show']);

Route::get('/threads', [ThreadsController::class, 'index'])->name('threads');
Route::get('/threads/create', [ThreadsController::class, 'create']);
Route::get('/threads/{channel}/{thread}', [ThreadsController::class, 'show']);
Route::patch('/threads/{channel}/{thread}', [ThreadsController::class, 'update']);
Route::delete('/threads/{channel}/{thread}', [ThreadsController::class, 'destroy']);
Route::post('/threads', [ThreadsController::class, 'store'])->middleware('must-be-confirmed');
Route::get('/threads/{channel}', [ThreadsController::class, 'index']);

Route::post('locked-threads/{thread}', [LockedThreadsController::class, 'store'])->name('locked-threads.store')->middleware('admin');
Route::delete('locked-threads/{thread}', [LockedThreadsController::class, 'destroy'])->name('locked-threads.destroy')->middleware('admin');

Route::get('/threads/{channel}/{thread}/replies', [RepliesController::class, 'index']);
Route::post('/threads/{channel}/{thread}/replies', [RepliesController::class, 'store']);
Route::patch('/replies/{reply}', [RepliesController::class, 'update']);
Route::delete('/replies/{reply}', [RepliesController::class, 'destroy'])->name('replies.destroy');

Route::post('/replies/{reply}/best', [BestRepliesController::class, 'store'])->name('best-replies.store');

Route::post('/threads/{channel}/{thread}/subscriptions', [ThreadSubscriptionsController::class, 'store'])->middleware('auth');
Route::delete('/threads/{channel}/{thread}/subscriptions', [ThreadSubscriptionsController::class, 'destroy'])->middleware('auth');

Route::post('/replies/{reply}/favorites', [FavoritesController::class, 'store']);
Route::delete('/replies/{reply}/favorites', [FavoritesController::class, 'destroy']);

Route::get('/profiles/{user}', [ProfilesController::class, 'show'])->name('profile');

Route::delete('/profiles/{user}/notifications/{notification}', [UserNotificationsController::class, 'destroy']);
Route::get('/profiles/{user}/notifications/', [UserNotificationsController::class, 'index']);

Route::get('/register/confirm', [RegisterConfirmationController::class, 'index'])->name('register.confirm');

Route::get('api/users', [UsersController::class, 'index']);

Route::post('api/users/{user}/avatar', [UserAvatarController::class, 'store'])->middleware('auth')->name('avatar');
