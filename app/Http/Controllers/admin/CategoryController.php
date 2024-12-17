<?php

namespace App\Http\Controllers\Admin;

use App\Models\c;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::select('id','name','description','role', 'parent_category_id','created_at')
                        ->where('role','sub')
                        ->paginate(4);
        $parentCategories = Category::select('name','id','description','role','created_at')->where('role','parent')->paginate(4);

        $parentCategoriesSelect = Category::select('name','id','description','role','created_at')->where('role','parent')->get();
        return view('admin.category.create', compact('parentCategories', 'categories', 'parentCategoriesSelect'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $this->validation($request);
        $categoryData = $this->getData($request);

        if($request->filled('categoryId')){
            $categoryData['parent_category_id'] = $request->categoryId;
        }

        try {
            // Create the category
            Category::create($categoryData);

            // Display success message
            alert()->success('Category Created Successfully');
            return back();
        }
        catch (\Exception $e) {
            // Log the error and show an error message
            Log::error('Category Creation Error: ' . $e->getMessage());
            alert()->error('Category Creation Failed', 'Please try again.');
            return back();
        }

    }

    //validate category data
    private function validation(Request $request){
        $request->validate([
            'subCategoryName' => ['required', 'min:5', 'max:40'],
            'description' => ['required', 'max:255'],
            'categoryId' => ['nullable','numeric'],
            'role' => ['required']
        ]);
    }

    //get category data
    private function getData(Request $request){
        return [
            'name' => $request->subCategoryName,
            'description' => $request->description,
            'role' => $request->role,
        ];
    }

    /**
     * Display the specified resource.
     */
    public function show(c $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(c $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, c $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request)
    {
        //
        Category::where('id',$request->id)->delete();
        alert()->success('Category Deleted Successfully');

        return to_route('category#list');
    }
}
