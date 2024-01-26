<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;

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

Route::get('/', [DashboardController::class, 'index']);

Route::get('/home', [DashboardController::class, 'index']);
Route::get('/home/1', function () {
    return redirect('/home');
});
Route::get('/home/{i}', [DashboardController::class, 'index']);

Route::get('/login', function () {
    $values = [
        'pageTitle' => 'Login',
        'action' => 'login'
    ];
    return view('auth/auth', $values);
});

Route::post('/loginok', [AuthController::class, 'login']);

Route::get('/signup', function () {
    $values = [
        'pageTitle' => 'Sign up',
        'action' => 'signup'
    ];
    return view('auth/auth', $values);
});

Route::post('/signupok', [AuthController::class, 'signup']);

Route::get('contact', function () {
    return "<h1>Contact Page</h1>";
});

Route::get('users/{id}', function ($id) {
    return "This is user $id";
})->name('edit-user');


Route::get('homes', function () {
    return "<a href='".route('edit-user','tin')."'>About</a>";
});

Route::group(['prefix' => 'customer'], function () {
    Route::get('/', function(){
        return "<h1>Customer List</h1>";
    });
    Route::get('/create' , function(){
        return "<h1>Create Customer</h1>";
    });
    Route::get('/show' , function(){
        return "<h1>Show Customers</h1>";
    });
});

Route::fallback(function(){
    return "<h1>Route not exists</h1>";
});
