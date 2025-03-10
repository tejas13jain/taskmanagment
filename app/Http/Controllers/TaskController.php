<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $groups = Project::all(); // Fetch all groups

        return view('tasks.create', compact('groups'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'due_date' => 'required',
            'status' => 'required'
        ]);

        $data = $request->all();
    
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }
    
        $data['user_id'] = auth()->id();
    
        Task::create($data);

        return redirect()->route('tasks.index');
    }

    public function edit($id)
    {
        $task = Task::find($id);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request) 
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'due_date' => 'required',
            'status' => 'required'
        ]);

        $task = Task::findOrFail($request->id); // Fetch the task before updating

        $data = $request->all();

        if ($request->hasFile('attachment')) {
            if ($task->attachment) {
                Storage::disk('public')->delete($task->attachment); // Delete old file
            }
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        $task->update($data);

        return redirect()->back();
    }


    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index');
    }
}