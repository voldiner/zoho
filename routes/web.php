<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DealController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\UserController;
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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/',[indexController::class, 'index'])->name('home');
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/account', [AccountController::class, 'index'])->name('account');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign');
Route::get('/deal', [DealController::class, 'index'])->name('deal');
