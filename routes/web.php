<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;
use App\Http\Controllers\CategoriaController;

Route::get('/', [NoticiaController::class,'index'])->name('home');

Route::resource('noticias', NoticiaController::class);
Route::resource('categorias', CategoriaController::class)->except(['show']);
