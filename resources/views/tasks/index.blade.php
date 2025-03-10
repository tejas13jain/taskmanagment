@extends('layouts.app')
@section('content')

<div class="container">

<a href="/task/create">Create Task</a>
<table class="table table-striped mt-3">
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Priority</th>
        <th>Status</th>
        <th>Due Date</th>
        <th>Actions</th>
    </tr>
    @foreach($tasks as $task)
    <tr>
        <td>{{ $task->title }}</td>
        <td>{{ $task->description }}</td>
        <td>{{ $task->priority }}</td>
        <td>{{ $task->status }}</td>
        <td>{{ $task->due_date }}</td>
        <td>
            <a class="btn btn-primary btn-sm" href="{{ route('task.edit', $task->id) }}">Edit</a>
            <form action="{{ route('task.destroy', $task->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-secondary btn-sm" type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
</div>
@endsection