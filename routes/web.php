<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use Illuminate\Support\Facades\Auth;

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
    if(Auth::check()) {
        return redirect('/home');
    }
    return view('auth.login');
});

//Acceder a la vista de un metodo del controlador

Route::resource('libro', LibroController::class)->middleware('auth');

Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [LibroController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'], function() {
    Route::get('/home', [LibroController::class, 'index'])->name('home');
});
