<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\ActorsController;
use App\Http\Controllers\TvController;

Route::get('/', [MoviesController::class, 'index'])->name('index');
Route::get('/movies/{movie}', [MoviesController::class, 'show'])->name('movies.show');

Route::get('/tv', [TvController::class, 'index'])->name('tvshow.index');
Route::get('/tv/{id}', [TvController::class, 'show'])->name('tvshow.show');

Route::get('/actors', [ActorsController::class, 'index'])->name('actors.index');
Route::get('/actors/page/{page?}', [ActorsController::class, 'actors.index']);

Route::get('/actors/{id}', [ActorsController::class, 'show'])->name('actors.show');
