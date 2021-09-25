<?php

use App\Http\Controllers\QuestionAdminController;


Route::get('/', function () {
    return view('welcome');
});



        // Route::get('myproducts', [QuestionAdminController::class, 'index']);
Route::delete('questions/{id}', [QuestionAdminController::class, 'destroy']);
Route::delete('questionsDeleteAll', [QuestionAdminController::class, 'deleteAll']);
    Route::resource('questions', QuestionAdminController::class)
        ->parameters(['questions'=>'id']);

