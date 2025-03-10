<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use App\Models\User;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::all();
        return view('groups.index', compact('groups'));
    }

    public function create()
    {
        $users = User::where('role_id', "user")->get();
        return view('groups.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Group::create($request->all());

        return redirect()->route('groups.index');
    }

    public function edit($id)
    {
        $group = Group::with('users')->find($id); // Ensure relationship is loaded
        $users = User::all(); // Fetch all users
    
        if (!$group) {
            return redirect()->route('groups.index')->with('error', 'Group not found.');
        }
        return view('groups.edit', compact('group', 'users'));
    
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $group = Group::find($request->id);
        $group->update($request->all());

        return redirect()->route('groups.index');
    }

    public function destroy($id)
    {
        Group::destroy($id);
        return redirect()->route('groups.index');
    }
}
