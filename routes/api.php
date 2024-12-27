<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\BookTypeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\BookController;

Route::get('/authors/paginate', [AuthorController::class, 'paginate']);
Route::apiResource('authors', AuthorController::class);
Route::get('/collections/paginate', [CollectionController::class, 'paginate']);
Route::apiResource('collections', CollectionController::class);
Route::get('/publishers/paginate', [PublisherController::class, 'paginate']);
Route::apiResource('publishers', PublisherController::class);
Route::get('/book-types/paginate', [BookTypeController::class, 'paginate']);
Route::apiResource('book-types', BookTypeController::class);
Route::get('/subjects/paginate', [SubjectController::class, 'paginate']);
Route::apiResource('subjects', SubjectController::class);
Route::apiResource('books', BookController::class);
