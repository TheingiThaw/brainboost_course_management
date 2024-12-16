<?php

namespace App\Http\Controllers\instructor;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InstructorController extends Controller
{
    //navigate dashboard
    public function dashboard(){
        $courseCount = Course::where('courses.instructor_id',Auth::user()->id)->count();
        return view('instructor.dashboard',compact('courseCount'));
    }

    public function list(){
        $instructors = User::select('id','name','email','phone','address','role','created_at','provider')
                        ->when(request('searchKey'),function($query){
                            $query->whereAny(['name','role','address'],'LIKE','%'.request('searchKey').'%');
                        })
                        ->where('role','instructor')
                        ->get();

        return view('admin.instructor.list',compact('instructors'));
    }

    //instructor responsible courses
    public function instructorCourses(){
        $courses = Course::select('courses.id','courses.image','courses.name','courses.price','users.name as instructor_name','categories.name as sub_category_name')
                    ->leftJoin('users','users.id','courses.instructor_id')
                    ->leftJoin('categories','categories.id','courses.sub_category_id')
                    ->when(request('searchKey'), function($query){
                        $query->whereAny(['courses.name','users.name'],'like','%'.request('searchKey').'%');
                    })
                    ->where('courses.instructor_id',Auth::user()->id)
                    ->get();
        return view('instructor.courses', compact('courses'));
    }
}
