<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Task;
use App\Models\Project;
class UserController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        return view('home', [
            'assignedTasks' => Task::where('user_id', $userId)->count(),
            'completedTasks' => Task::where('user_id', $userId)->where('status', 'Completed')->count(),
            'pendingTasks' => Task::where('user_id', $userId)->where('status', '!=', 'Completed')->count(),
            'upcomingDeadlines' => Task::where('user_id', $userId)->whereDate('due_date', '>=', now())->orderBy('due_date')->limit(5)->get(),
            'projects' => Project::where('user_id', $userId)->get(),
        ]);
       
    }

    public function profile()
    {
        return view('profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->name;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Profile updated.');
    }
}
