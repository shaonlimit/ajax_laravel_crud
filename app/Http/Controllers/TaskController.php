<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::latest()->paginate(10);
        $sl = !is_null(\request()->page) ? (\request()->page - 1) * 10 : 0;
        return view('tasks.task_index', compact('tasks', 'sl'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:tasks',
            'description' => 'required',
        ]);
        Task::create($request->all());
        return response()->json([
            'status' => 'success',
        ]);
    }
    public function update(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Task::where('id', $request->id)->first()->update($data);
        return response()->json([
            'status' => 'success',
        ]);
    }
    public function delete(Request $request)
    {
        Task::where('id', $request->id)->first()->delete();
        return response()->json([
            'status' => 'success',
        ]);
    }

    public function show(Request $request)
    {
        Task::find($request->id);
        return response()->json([
            'status' => 'success',
        ]);
    }
    public function pagination(Request $request)
    {
        $tasks = Task::latest()->paginate(10);
        $sl = !is_null(\request()->page) ? (\request()->page - 1) * 10 : 0;
        return view('tasks.task_pagination', compact('tasks', 'sl'))->render();
    }
    public function search(Request $request)
    {
        $tasks = Task::where('name', 'like', '%' . $request->search_string . '%')
            ->orWhere('description', 'like', '%' . $request->search_string . '%')
            ->orderBy('id', 'desc')->paginate(10);
        if ($tasks->count() >= 1) {
            $sl = !is_null(\request()->page) ? (\request()->page - 1) * 10 : 0;
            return view('tasks.task_pagination', compact('tasks', 'sl'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
}
