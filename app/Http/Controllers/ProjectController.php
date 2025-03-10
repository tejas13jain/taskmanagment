<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Task;

class ProjectController extends Controller
{
    public function user_Task()
    {
        $userGroups = GroupUser::where('user_id', Auth::id())->pluck('group_id');
        $groupData = Group::whereIn('id', $userGroups)->pluck('project_id');

        $projects = Project::whereIn('id', $groupData)->get();

        return view('projects.userDash', compact('projects'));
    }

    public function subTask($id)
    {
              
        $task = Task::where('user_id',Auth::id())->where('group_id',$id)->get();
        // dd($user);
        return view('projects.subTask', compact('task'));
    }

    public function updatePriority(Request $request, $id)
    {
        $request->validate([
            'priority' => 'required'
        ]);
        
        $project = Task::findOrFail($id);
        $project->update(['id' => $request->projects_id,'status' => $request->priority]);

        return response()->json(['message' => 'Priority updated successfully.']);
    }

    public function getAllProjects()
    {
        $projects = Project::all();
        $user = User::where('role_id', "user")->get();
        // dd($user);
        return view('projects.index', compact('projects', 'user'));
    }

    public function create()
    {
        $user = User::where('role_id', "user")->get();
        $group = Group::all();
        // dd($user);
        return view('projects.create', compact('user', 'group'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date'
        ]);

        $Project = Project::create([
            'name' => $request->name, 
            'status' => $request->status,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => $request->user_id,
        ]);

        return redirect()->back();
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit($id)
    {
      
        $project = Project::where('id', $id)->first();  
        $group = Group::all();
        return view('projects.edit', compact('project','group'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date'
        ]);
        
        $project = Project::findOrFail($request->id);
        $project->update($request->all());

        return redirect()->back();
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }

   
}
