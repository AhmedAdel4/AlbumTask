<?php

use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;

Route::get('/',[AlbumController::class, 'index'])->name('home');
Route::get('albums/{album}/Images',[AlbumController::class, 'uploadeImage'])->name('albums.Images');
Route::get('albums/{albumId}/moveImages',[AlbumController::class, 'moveImages'])->name('albums.moveImages');
Route::post('albums/storeMovedImages',[AlbumController::class, 'storeMovedImages'])->name('albums.moveImages.store');
Route::post('albums/Images',[AlbumController::class, 'storeImage'])->name('albums.store.Image');
Route::resource('albums',AlbumController::class)->except(['show']);
Route::delete('albums/images/{id}', [AlbumController::class, 'deleteImage'])->name('albums.images.delete');
