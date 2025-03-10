@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Projects</h2>
   
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>{{ $project->name }}</td>
                <td>{{ $project->status }}</td>
                <td>{{ $project->start_date }}</td>
                <td>{{ $project->end_date }}</td>
                <td>
                    <a href="{{ route('task.subTask', $project->id) }}" class="btn btn-warning">Edit</a>
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
