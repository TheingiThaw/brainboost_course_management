<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\EnrolController;
use App\Http\Controllers\admin\CourseController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\CategoryController;

    Route::group(['prefix' => 'admin'],function(){
        Route::group(['middleware' => 'admin'],function(){
            Route::get('dashboard', [AdminController::class,'dashboard'])->name('admin#dashboard');
            Route::get('list', [AdminController::class,'adminList'])->name('admin#list');
            Route::get('review', [AdminController::class,'reviewList'])->name('review#list');
        });

        Route::get('user/list', [AdminController::class,'userList'])->name('user#list');
        Route::get('instructor/list', [AdminController::class,'instructorList'])->name('instructor#list');

        Route::group(['prefix'=>'account'],function(){
            Route::get('profile', [ProfileController::class,'profile'])->name('account#profile');
            Route::get('changePassword', [ProfileController::class, 'navigateChangePassword'])->name('account#changePassword');
            Route::post('changePassword', [ProfileController::class, 'changePassword'])->name('change#password');
            Route::get('editpage', [ProfileController::class, 'edit'])->name('account#edit');
            Route::post('edit/profile', [ProfileController::class, 'editProfile'])->name('profile#edit');
            Route::post('delete/{id}', [ProfileController::class, 'delete'])->name('profile#delete');
            Route::group(['middleware' => 'admin'], function(){
                Route::get('new', [ProfileController::class, 'newAdmin'])->name('admin#new');
                Route::post('new', [ProfileController::class, 'addNewAdmin'])->name('newadmin#add');
                Route::get('add', [ProfileController::class,'instructorAdd'])->name('instructor#add');
                Route::post('add', [ProfileController::class,'addNewInstructor'])->name('instructor#create');
                Route::get('edit', [ProfileController::class,'instructoredit'])->name('instructor#edit');
                Route::post('edit', [ProfileController::class,'editProfile'])->name('edit#instructor');
            });
        });

        Route::group(['prefix' => 'category', 'middleware' => 'admin'],function(){
            Route::get('list', [CategoryController::class,'create'])->name('category#list');
            Route::post('create', [CategoryController::class,'store'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class,'delete'])->name('category#delete');
        });

        Route::group(['prefix' => 'course'],function(){
            Route::get('list', [CourseController::class,'list'])->name('course#list');
            Route::get('seemore/{id}', [CourseController::class,'seemore'])->name('course#seemore');
            Route::get('edit/{id}', [CourseController::class,'edit'])->name('course#edit');
            Route::post('edit/{id}', [CourseController::class,'editCourse'])->name('edit#course');
            Route::get('delete/{id}', [CourseController::class,'deleteCourse'])->name('course#delete');
            Route::get('questions', [AdminController::class,'questionList'])->name('questions#list');

            Route::group(['middleware' => 'admin'],function(){
                Route::post('delete/{id}', [CourseController::class,'delete'])->name('course#delete');
                Route::get('create', [CourseController::class,'create'])->name('course#create');
                Route::post('store', [CourseController::class,'store'])->name('course#store');

                Route::group(['prefix' => 'section'],function(){
                    Route::post('create/{id}', [CourseController::class,'sectionCreate'])->name('section#create');
                    Route::post('create/lecture/{id}',[CourseController::class,'lectureCreate'])->name('lecture#create');
                    Route::post('edit/lecture/{id}',[CourseController::class,'lectureEdit'])->name('lecture#edit');
                    Route::get('delete/lecture/{id}/',[CourseController::class,'lectureDelete'])->name('lecture#delete');
                    Route::get('delete/{id}',[CourseController::class,'sectionDelete'])->name('section#delete');
                });
            });
        });

        Route::group(['prefix' => 'enrol','middleware' => 'admin'],function(){
            Route::get('list', [EnrolController::class,'list'])->name('enrol#list');
            Route::get('status/onchange', [EnrolController::class,'onchange'])->name('status#onchange');
            Route::get('detail/{enrolCode}', [EnrolController::class,'detail'])->name('enrol#detail');
            Route::get('confirm', [EnrolController::class,'enrolConfirm'])->name('enroll#confirm');
            Route::get('reject', [EnrolController::class,'enrolReject'])->name('enroll#reject');
        });

    });

