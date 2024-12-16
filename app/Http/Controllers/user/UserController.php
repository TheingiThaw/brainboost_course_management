<?php

namespace App\Http\Controllers\user;

use App\Models\Goal;
use App\Models\User;
use App\Models\Course;
use App\Models\Review;
use App\Models\Section;
use App\Models\Bookmark;
use App\Models\Category;
use App\Models\Question;
use App\Models\Enrolment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //direct home page
    public function home(){
        $courses = Enrolment::select('courses.id','courses.name','courses.image','courses.price','courses.level','courses.duration','users.name as instructor_name',
                        DB::raw('(SELECT AVG(rating) FROM reviews WHERE reviews.course_id = courses.id) as average_rating'),
                        DB::raw('(SELECT COUNT(user_id) FROM enrolments WHERE enrolments.course_id = courses.id) as student_count')
                    )
                    ->leftJoin('courses','courses.id','enrolments.course_id')
                    ->leftJoin('users','users.id','enrolments.user_id')
                    ->orderBy('student_count')
                    ->limit(3)->get();

        $instructors = User::where('role','instructor')->limit(4)->get();
        return view('user.home',compact('instructors','courses'));
    }

    //about page
    public function about(){
        $instructors = User::where('role','instructor')->get();
        return view('user.about', compact('instructors'));
    }

    //team page
    public function team(){
        $instructors = User::where('role','instructor')->get();
        return view('user.team', compact('instructors'));
    }

    //testimonial page
    public function testimonial(){
        $reviews = Review::select('users.name as name','courses.name as course_name','reviews.commment as comment')
                    ->leftJoin('users','users.id','reviews.user_id')
                    ->leftJoin('courses','courses.id','reviews.course_id')
                    ->get();
        return view('user.testimonial');
    }

    //contact page
    public function contact(){
        return view('user.contact');
    }

    //user dashboard navigation
    public function dashboard(){
        $courseCount = Enrolment::where('user_id',Auth::user()->id)->count('course_id');
        return view('user.dashboard.dashboard', compact('courseCount'));
    }

    //navigate user profile
    public function profile(){
        $profile = User::where('id', Auth::user()->id)->first();
        return view('user.account.profile', compact('profile'));
    }

    public function update(Request $request){
        $userData = $this->getUserData($request);

        if($request->hasfile('image')){
            if(file_exists(public_path('profilePhoto/'.$request->image))){
                unlink(public_path('profilePhoto/'.$request->image));
            }
            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path().'/profilePhoto/', $fileName);
            $userData['profile'] = $fileName;
        }
        User::where('id', Auth::user()->id)->update($userData);
        alert()->success('Profile Update Success', 'Profile Updated Successfully');
        return back();
    }

    //get user data
    private function getUserData(Request $request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }

    //list courses
    public function courses(){
        $courses = Course::select('courses.id','courses.name','courses.price','courses.image', 'courses.duration','users.name as instructor_name')
                    ->leftJoin('users','users.id','courses.instructor_id')
                    ->get();
        return view('user.course.list', compact('courses'));
    }

    //course detial page
    public function detail($id) {
        $course = Course::select(
            'courses.id',
            'courses.name',
            'courses.price',
            'courses.level',
            'courses.image',
            'courses.updated_at',
            'courses.duration',
            'courses.certificate',
            'users.name as instructor_name',
            'users.id as user_id',
            'users.created_at',
            'users.profile',
            'users.email'
        )
        ->leftJoin('users', 'users.id', 'courses.instructor_id')
        ->where('courses.id', $id) // Disambiguate by specifying the table
        ->first();

        $sections = Section::where('course_id',$id)->get();

        $reviews = Review::select('reviews.commment','reviews.created_at','users.name','users.profile')
                    ->leftJoin('users','users.id','reviews.user_id')
                    ->where('course_id',$id)->paginate(4);
        $rateCount = number_format(Review::where('course_id',$id)->avg('rating'));

        // Use a variable `$id` instead of a string `'$id'` in the where clause for goals
        $goals = Goal::select('id', 'goal')->where('course_id', $id)->get();

        return view('user.course.detail', compact('course', 'goals', 'sections','reviews','rateCount'));
    }

    public function sectionDetail($id){
        $course = Course::where('id',$id)->first();
        $sections = Section::with('lectures')->where('course_id',$id)->get();
        $questions = Question::select('questions.id','questions.question','questions.answer','users.profile','users.name','questions.created_at')
                    ->leftJoin('users','users.id','questions.user_id')
                    ->where('course_id',$id)->get();
        return view('user.course.section',compact('sections','course', 'questions'));
    }

    //store user questions
    public function question(Request $request,$id){
        $request->validate([
            'question' => 'required|max:255'
        ]);

        $questionData = [
            'user_id' => $request->user()->id,
            'course_id' => $id,
        ];

        if(request()->user()->role == 'user'){
            $questionData['question'] = $request->question;
        }
        else{
            $questionData['answer'] = $request->question;
        }

        Question::create($questionData);
        alert()->toast('Question submitted successfully');
        return back();
    }

    //user review on course or instructor
    public function review(Request $request){

        $request->validate([
            'courseId' => 'required|integer',
            'comment' => 'required|max:255',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Review::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'course_id' => $request->courseId,
            ],
            [
                'commment' => $request->comment,
                'rating' => $request->rating,
            ]
        );

        alert()->success('Thanks for Rating');
        return back();
    }

    //user bookmark course
    public function bookmark(Request $request){
        logger($request);

        Bookmark::updateOrCreate([
            'user_id' => $request['userId'],
            'course_id' => $request['courseId']
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Course bookmarked successfully.',
        ]);
}

    //user bookmarks page
    public function bookmarkList(){
        $bookmarks = Bookmark::select('courses.id','courses.name','courses.image','courses.price','courses.level','courses.duration','users.name as instructor_name',
                        DB::raw('(SELECT AVG(rating) FROM reviews WHERE reviews.course_id = courses.id) as average_rating'),
                        DB::raw('(SELECT COUNT(user_id) FROM enrolments WHERE enrolments.course_id = courses.id) as student_count')
                    )
                        ->leftJoin('courses','courses.id','bookmarks.course_id')
                        ->join('enrolments','enrolments.course_id','bookmarks.course_id')
                        ->join('users','users.id','courses.instructor_id')
                        ->where('bookmarks.user_id',Auth::user()->id)->get();
        return view('user.dashboard.bookmark',compact('bookmarks'));
    }

    //user mycourses page
    public function myCourses(){
        $courses = Enrolment::select('courses.id','courses.name','courses.image','courses.price','courses.level','courses.duration','users.name as instructor_name',
                        DB::raw('(SELECT AVG(rating) FROM reviews WHERE reviews.course_id = courses.id) as average_rating'),
                        DB::raw('(SELECT COUNT(user_id) FROM enrolments WHERE enrolments.course_id = courses.id) as student_count')
                    )
                    ->leftJoin('courses','courses.id','enrolments.course_id')
                    ->join('users','users.id','courses.instructor_id')
                    ->where('user_id',Auth::user()->id)
                    ->where('enrolments.status',1)->get();

        return view('user.dashboard.courses', compact('courses'));
    }

}
