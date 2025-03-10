@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Project</h2>
    <form action="{{ route('projects.update') }}" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{ $project->id }}">
        <div class="mb-3">
            <label>Name:</label>
            <input type="text" name="name" value="{{ $project->name }}"  class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Description:</label>
            <textarea name="description" class="form-control">{{ $project->description }}</textarea>
        </div>
        <div class="mb-3">
            <label>Status:</label>
            <select name="status" class="form-control">
                <option value="Not Started" {{ $project->status == 'Not Started' ? 'selected' : '' }}>Not Started</option>
                <option value="In Progress" {{ $project->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                <option value="Completed" {{ $project->status == 'Completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Start Date:</label>
            <input type="date" name="start_date" class="form-control" value="{{ $project->start_date }}" required>
        </div>
        <div class="mb-3">
            <label>End Date:</label>
            <input type="date" name="end_date" class="form-control" value="{{ $project->end_date }}"  required>
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
