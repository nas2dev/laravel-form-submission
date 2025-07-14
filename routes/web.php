<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormSubmissionController;

// Route::get('/', function () {
//     return view('welcome');
// });


// Route::get('/test', function () {
//     return "Hello World";
// });

Route::controller(FormSubmissionController::class)->group(function () {
    Route::get('/', 'index')->name('HomePage');
    Route::post('/store', 'store')->name('FormSubmission.store');
    Route::get('/submissions', 'submissions')->name('SubmissionsPage');
    // Route::get('/submissions', 'submissions')->name('SubmissionsPage')->middleware('isAdmin');
    Route::get('/all-submissions', 'allSubmissions')->name('SubmissionsPage.all');
});