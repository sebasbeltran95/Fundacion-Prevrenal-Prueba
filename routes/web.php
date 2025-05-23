<?php

use App\Http\Livewire\Categoria;
use App\Http\Livewire\Estados;
use App\Http\Livewire\Tareas;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
// Auth::routes(['register' => false]);

Route::get('/',function(){ return redirect('login'); });


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function (){
    Route::get('/tareas', Tareas::class)->name('tareas');
    Route::get('/categoria', Categoria::class)->name('categoria');
    Route::get('/estados', Estados::class)->name('estados');
    // Route::get('/perfil', Perfil::class)->name('perfil');
    // Route::get('/user', Usuarios::class)->name('user');
    // Route::get('/contactanosBack', ContactanosBack::class)->name('contactanosBack');
    // Route::get('/contactanosDashboard', ContactanosDashboard::class)->name('contactanosDashboard');
    // Route::get('/contactanosHistorial', ContactanosHistorial::class)->name('contactanosHistorial');
});