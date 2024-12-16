<?php

namespace App\Http\Controllers\admin;

use App\Models\Goal;
use App\Models\User;
use App\Models\Course;
use App\Models\Lecture;
use App\Models\Section;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    //list courses
    public function list(Request $request){
        $courses = Course::select('courses.id','courses.image','courses.name','courses.price','users.name as instructor_name','categories.name as sub_category_name')
                    ->leftJoin('users','users.id','courses.instructor_id')
                    ->leftJoin('categories','categories.id','courses.sub_category_id')
                    ->when(request('searchKey'), function($query){
                        $query->whereAny(['courses.name','users.name'],'like','%'.request('searchKey').'%');
                    })
                    ->get();
        return view('admin.courses.list', compact('courses'));
    }

    //navigate to create page
    public function create(){
        $parentCategories = Category::select('id','name')->where('role','parent')->get();
        $subCategories = Category::select('id','name')->where('role','sub')->get();
        $instructors = User::select('id','name')->where('role','instructor')->get();
        return view('admin.courses.create', compact('parentCategories','subCategories','instructors'));
    }

    public function store(Request $request){
        $this->validation($request, 'create');

        $data = $this->getCourseData($request);

        if($request->has('FOC')){
            $data['FOC'] = $request->input('FOC');
        }

        $imgFile = uniqid() .$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('course'), $imgFile);

        $data['image'] = $imgFile;

        $course = Course::create($data);
        $goalData = [];

        foreach($request->input('goal') as $goal){
            $goalData[] = [
                'goal' => $goal,
                'course_id' => $course->id
            ];
        }

        Goal::insert($goalData);

        alert()->success('New Course Created Successfully');
        return to_route('course#list');
    }


    //get data
    private function getCourseData(Request $request){
        return [
            'name' => $request->name,
            'title' => $request->title,
            'category_id' => $request->categoryId,
            'sub_category_id' => $request->subCategoryId,
            'certificate' => $request->certificate,
            'level' => $request->level,
            'price' => $request->price,
            'duration' => $request->duration,
            'instructor_id' => $request->instructorId,
            'resource' => $request->resource,
            'prerequisite' => $request->prerequisites,
            'description' => $request->description,
        ];
    }

    //validate course data
    private function validation(Request $request, $action) {
        $rules = [
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'categoryId' => 'required|integer',
            'subCategoryId' => 'required|integer',
            'certificate' => 'required|in:0,1',
            'instructorId' => 'required|integer',
            'level' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'resource' => 'required|string',
            'prerequisites' => 'required|string',
            'description' => 'required|string',
            'goal' => 'required|array',
            'goal.*' => 'required|string|max:255',
            'FOC' => 'nullable',
        ];
        $message = [];
        $rules['image'] = $action == 'create' ? 'required|image|mimes:jpeg,png,jpg,gif|max:2048' : 'image|mimes:jpeg,png,jpg,gif|max:2048';

        $request->validate($rules, $message);
    }

    //edit course
    public function edit($id){
        $course = Course::where('id',$id)->first();
        $parentCategories = Category::select('id','name')->where('role','parent')->get();
        $subCategories = Category::select('id','name')->where('role','sub')->get();
        $instructors = User::select('id','name')->where('role','instructor')->get();
        $goals = Goal::select('id','goal')->where('course_id',$id)->get();
        return view('admin.courses.edit', compact('course','parentCategories','subCategories','instructors','goals'));
    }

    //edit course
    public function editCourse(Request $request,$id){
        $this->validation($request, 'update');
        $data = $this->getCourseData($request);

        $oldImage = $request->oldImage;
        if($request->hasfile('image')){
            if(file_exists(public_path('course/'.$oldImage))){
                unlink(public_path('course/'.$oldImage));
            }

            $imgFileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('course/'. $imgFileName));
            $data['image'] = $imgFileName;
        }

        $goalData = [];

        Goal::where('course_id',$id)->delete();
        foreach ($request->input('goal') as $goal) {
            $goalData[] =[
                'goal' => $goal,
                'course_id' => $id,
            ];
        }
        Goal::insert($goalData);

        Course::where('id', $id)->update($data);
        alert()->success('Course Updated Successfully');
        return back();
    }

    //delete Course
    public function deleteCourse($id){

        Goal::where('course_id', $id)->delete();

        $sections = Section::select('id')->where('course_id', $id)->get();

        foreach ($sections as $section) {
            Lecture::where('section_id', $section->id)->delete();
        }

        Section::where('course_id', $id)->delete();

        Course::where('id', $id)->delete();

        // Success alert
        alert()->success('Course Deleted Successfully');
        return to_route('course#list');
    }


    //see more course
    public function seemore($id){
        $course = Course::where('id',$id)->first();
        $sections = Section::with('lectures')->where('course_id',$id)->get();
        $lectures = Lecture::select('lectures.name','lectures.id','lectures.description','lectures.video')
                    ->leftJoin('sections','sections.id','lectures.section_id')
                    ->get();
        return view('admin.section.list',compact('course', 'sections', 'lectures'));
    }


    //create section
    public function sectionCreate(Request $request, $id){
        $request->validate([
            'course_id' => 'required',
            'description' => 'required|string|max:255',
            'title' => 'required|string|max:255'
        ]);

        $data = [
            'title' => $request->title,
            'course_id' => $request->course_id,
            'description' => $request->description
        ];

        Section::create($data);
        alert()->success('New Section Added');
        return back();
    }

    public function lectureCreate(Request $request){

        try{
            $request->validate([
                'name' => 'required',
                'section_id' => 'required',
                'description' => 'required|max:255',
                'url' => 'required|string|max:255'
            ]);

            $data = [
                'name' => $request->name,
                'section_id' => $request->section_id,
                'description' => $request->description,
                'video' => $request->url
            ];

            Lecture::create($data);
            alert()->success('New Lecture Added');

            return response()->json([
                'success' => true
            ]);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()], 500);
        }
}



    //lecture edition
    public function lectureEdit(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'url' => 'nullable|url',
        ]);

        $data = [
            'name' => $request->name,
            'section_id' => $request->section_id,
            'description' => $request->description,
            'video' => $request->url
        ];

        Lecture::where('id',$id)->update($data);
        alert()->success('Section Edited Successfully');
        return back();
    }

    public function lectureDelete(Request $request,$id){
        // Find the lecture to delete
        if ($request['section_id']) {
            Lecture::where('id',$id)->where('section_id',$request['section_id'])->delete();
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => 'Lecture not found'], 404);
        }
    }

    //section deletion
    public function sectionDelete($id){
        Lecture::where('section_id',$id)->delete();
        Section::where('id',$id)->delete();

        alert()->success('Section Deleted Successfully');
        return back();
    }
}
