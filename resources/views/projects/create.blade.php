@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Project</h2>
    <form action="{{ route('projects.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="Not Started">Not Started</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Start Date:</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>End Date:</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Select User</label>
            <select name="user_id" class="form-control">
                <option value="">Select User</option>
                @foreach($user as $u)
                <option value="{{$u->id}}">{{$u->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Group</label>
            <select name="project_id" class="form-control">
                <option value="">Select Group</option>
                @foreach($group as $u)
                <option value="{{$u->id}}">{{$u->name}}</option>
                @endforeach
            </select>
        </div>
        <br>
        <button class="btn btn-success">Create Project</button>
    </form>
</div>
@endsection
