<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('tasks')->get();
        return view('todo-list.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'title' => 'required | min:3 | unique:categories,title',
                'description' => 'required | min:4 ',
            ],
            [
                'title.required' => 'The title field is required.',
                'title.unique' => 'The title is already taken.',
                'title.min' => 'The title must be at least 3 characters.',
                'description.required' => 'The description field is required.',
                'description.min' => 'The description must be at least 4 characters.',
            ]
        );
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $task = Category::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
            ]
        );
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $category = Category::find($id);
        $validate = Validator::make(
            $request->all(),
            [
                'title' => 'required|min:3|unique:categories,title,' . $category->id,
                'description' => 'required | min:4 ',
            ],
            [
                'title.required' => 'The title field is required.',
                'title.unique' => 'The title is already taken.',
                'title.min' => 'The title must be at least 3 characters.',
                'description.required' => 'The description field is required.',
                'description.min' => 'The description must be at least 4 characters.',
            ]
        );
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $category->update(
            [
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::user()->id,
            ]
        );
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }


    public function softdelete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }

    public function delete($id)
    {
        $category = Category::onlyTrashed()->find($id);
        $category->forceDelete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }

    function getTrashedCategory()
    {
        $categories = Category::onlyTrashed()->get();
        return view('todo-list.category.trash', ['categories' => $categories]);
    }
    function restore($id)
    {
        $category = Category::onlyTrashed()->find($id);
        $category->restore();
        return redirect()->route('category.index')->with('success', 'Category restored successfully.');
    }
}
