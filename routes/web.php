<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;

Route::get('/',[AlbumController::class, 'index'])->name('home');
Route::get('albums/{album}/Images',[AlbumController::class, 'uploadeImage'])->name('albums.Images');
Route::post('albums/Images',[AlbumController::class, 'storeImage'])->name('albums.store.Image');
Route::resource('albums',AlbumController::class)->except(['show']);
