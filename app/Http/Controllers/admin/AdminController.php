<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Review;
use App\Models\Question;
use App\Models\Enrolment;
use Illuminate\Http\Request;
use App\Models\PaymentHistory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //direct dashboard
    public function dashboard(){
        $totalRevenue = PaymentHistory::sum('total_amt');
        $userCount = User::where('role','user')->count('id');
        $pendings = Enrolment::where('status',0)->count('id');
        $enrolments = Enrolment::where('status',1)->count('id');
        return view('admin.dashboard',compact('totalRevenue','userCount','pendings','enrolments'));
    }

    //direct admin list page
    public function adminList(Request $request){
        $admins = User::select('id','name','email','phone','address','role','created_at','provider')
                    ->when(request('searchKey'),function($query){
                        $query->whereAny(['name','role','address'],'LIKE','%'.request('searchKey').'%');
                    })
                    ->whereIn('role', ['admin', 'superadmin'])->get();

        return view('admin.account.adminList',compact('admins'));
    }

    //direct user list page
    public function userList(Request $request){
        $users = User::select('id','name','email','phone','address','role','created_at','provider')
                    ->when(request('searchKey'),function($query){
                        $query->whereAny(['name','role','address'],'LIKE','%'.request('searchKey').'%');
                    })
                    ->where('role', 'user')->get();

        return view('admin.account.userList',compact('users'));
    }

    //instructor page navigation
    public function instructorList(){
        $instructors = User::select('id','name','email','phone','address','role','created_at','provider')
                        ->when(request('searchKey'),function($query){
                            $query->whereAny(['name','role','address'],'LIKE','%'.request('searchKey').'%');
                        })
                        ->where('role','instructor')->get();

        return view('admin.instructor.list',compact('instructors'));
    }

    //question list page navigation
    public function questionList(){
        $questions = Question::select(
            'questions.id',
            'questions.question',
            'questions.course_id',
            'questions.answer',
            'courses.name as course_name',
            'courses.image',
            'categories.name as sub_category_name',
            'users.name as instructor_name'
        )
            ->leftJoin('courses', 'courses.id', 'questions.course_id')
            ->join('categories', 'categories.id', 'courses.sub_category_id')
            ->join('users','users.id','courses.instructor_id')
            ->when(request('searchKey'), function ($query) {
                $query->where('questions.question', 'like', '%' . request('searchKey') . '%');
            })
            ->whereNull('questions.answer')
            ->get();

        return view('admin.questions', compact('questions'));

    }

    //review list page
    public function reviewList(){
        $reviews = Review::select('reviews.commment','reviews.rating','users.profile','users.name as user_name','courses.id','courses.name as course_name')
                    ->leftJoin('users','users.id','reviews.user_id')
                    ->leftJoin('courses','courses.id','reviews.course_id')
                    ->get();

        return view('admin.reviews', compact('reviews'));
    }
}
