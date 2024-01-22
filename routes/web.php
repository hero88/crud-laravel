<?php

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
    return view('welcome');
});

Route::get('about', function () {
    // $about = 'This is about page';
    // $about2 = 'This is about page 2';
    //return view('about', compact('about', 'about2'));
    return view('about');
})->name('about');

Route::get('contact', function () {
    return "<h1>Contact Page</h1>";
});

Route::get('users/{id}', function ($id) {
    return "This is user $id";
})->name('edit-user');

Route::get('home', function () {
    $blogs = [
        [
            'title' => 'Blog 1',
            'content' => 'This is blog 1 content',
        ],
        [
            'title' => 'Blog 2',
            'content' => 'This is blog 2 content',
        ],
        [
            'title' => 'Blog 3',
            'content' => 'This is blog 3 content',
        ],
        [
            'title' => 'Blog 4',
            'content' => 'This is blog 4 content',
        ]
    ];
    return view('home', compact('blogs'));
});

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
