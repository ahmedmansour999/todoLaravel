<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::all();
        $categories = Category::all();
        return view('todo-list.allTasks.index', compact('tasks', 'categories'));
    }


    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'title' => 'required | min:3 | unique:tasks,title',
                'description' => 'required | min:4 ',
                'status' => 'required ',
                'category_id' => 'required|exists:categories,id'
            ],
            [
                'title.required' => 'The title field is required.',
                'title.unique' => 'The title is already taken.',
                'title.min' => 'The title must be at least 3 characters.',
                'description.required' => 'The description field is required.',
                'description.min' => 'The description must be at least 4 characters.',
                'status.required' => 'The status field is required.',
                'category_id.required' => 'The category field is required.',
                'category_id.exists' => 'The selected category does not exist.'
            ]
        );
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $task = Task::create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'status' => $request->status,
                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id,
            ]
        );
        return redirect()->route('allTasks')->with('success', 'Task created successfully.');
    }


    public function update(Request $request,$id)
    {
        $task = Task::find($id) ;
        $validate =  Validator::make(
            $request->all(),
            [
                'title' => 'required|unique:tasks,title,' . $task->id,
                'description' => 'required|min:4',
                'status' => 'required',
                'category_id' => 'required|exists:categories,id'

            ],
            [
                'title.required' => 'The title field is required.',
                'title.unique' => 'The title is already taken.',
                'description.required' => 'The description field is required.',
                'description.min' => 'The description must be at least 4 characters.',
                'status.required' => 'The status field is required.',
                'category_id.required' => 'The category field is required.',
                'category_id.exists' => 'The selected category does not exist.'
            ]
        );
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }
        $task->update(
            [
                'title' => $request->title,
                'description' => $request->description,
               'status' => $request->status,
                'category_id' => $request->category_id,
                'user_id' => Auth::user()->id,
            ]
        );
        return redirect()->route('allTasks')->with('success', 'Task updated successfully');

    }

    public function softdelete($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('allTasks')->with('success', 'task deleted successfully.');
    }

    public function delete($id)
    {
        $task = Task::onlyTrashed()->find($id);
        $task->forceDelete();
        return redirect()->route('task.deletedTask')->with('success', 'Task deleted successfully.');
    }

    function getTrashedTask()
    {
        $tasks = Task::onlyTrashed()->get();
        return view('todo-list.allTasks.trash', ['tasks' => $tasks]);
    }
    function restore($id)
    {
        $task = Task::onlyTrashed()->find($id);
        $task->restore();
        return redirect()->route('allTasks')->with('success', 'Task restored successfully.');
    }
}
