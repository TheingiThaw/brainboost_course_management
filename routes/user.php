<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\user\EnrolmentController;


    Route::get('team', [UserController::class,'team'])->name('team');
    Route::get('home', [UserController::class,'home'])->name('user#home');
    Route::get('about', [UserController::class,'about'])->name('about');
    Route::get('testimonial', [UserController::class,'testimonial'])->name('testimonial');
    Route::get('contact', [UserController::class,'contact'])->name('contact');
    Route::get('enrolment', [EnrolmentController::class,'enrolment'])->name('enrolment');

    Route::group(['prefix' => 'user'],function(){
        Route::group(['middleware' => 'user'],function(){
            Route::get('tempStorage', [EnrolmentController::class,'tempStorage'])->name('user#tempStorage');
            Route::get('enrolPage', [EnrolmentController::class,'toEnrolPage'])->name('user#enrol#page');
            Route::post('enrol', [EnrolmentController::class,'enrol'])->name('user#enrol');
            Route::get('enrol/list', [EnrolmentController::class,'enrolList'])->name('user#enrol#list');

            Route::group(['prefix' => 'account'], function () {
                Route::get('dashboard', [UserController::class, 'dashboard'])->name('user#dashboard');
                Route::get('profile', [UserController::class, 'profile'])->name('user#profile');
                Route::post('update', [UserController::class, 'update'])->name('user#update');
                Route::get('myCourses',[UserController::class,'myCourses'])->name('user#mycourses');
                Route::get('bookmark',[UserController::class,'bookmarkList'])->name('user#bookmarks');
            });
        });

        Route::group(['prefix' => 'course'], function(){
            Route::get('join/{id}', [EnrolmentController::class,'join'])->name('course#join');
            Route::get('delete', [EnrolmentController::class,'delete'])->name('enrolment#delete');
            Route::post('review', [UserController::class,'review'])->name('user#review');

            Route::get('bookmark',[UserController::class,'bookmark'])->name('user#bookmark');
        });
    });

    Route::group(['prefix' => 'course'], function () {
        Route::get('list', [UserController::class, 'courses'])->name('courses#list');
        Route::get('detail/{id}', [UserController::class,'detail'])->name('courses#detail');
        Route::get('section/{id}', [UserController::class,'sectionDetail'])->name('section#detail');
        Route::get('courses', [UserController::class,'myCourses'])->name('user#courses');
        Route::post('question/{id}', [UserController::class,'question'])->name('user#question');

    });

