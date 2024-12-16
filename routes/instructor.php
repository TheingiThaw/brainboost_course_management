<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\instructor\InstructorController;


Route::group(['prefix' => 'instructor', 'middleware' => 'instructor'],function(){
    Route::get('dashboard', [InstructorController::class,'dashboard'])->name('instructor#dashboard');
    Route::get('list', [InstructorController::class,'list'])->name('instructor#list');

    Route::get('courses', [InstructorController::class,'instructorCourses'])->name('instructor#courses');
});
