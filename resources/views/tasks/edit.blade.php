@extends('layouts.app')

@section('content')
<div class="container">
<form action="/taskUpdate" method="POST" enctype="multipart/form-data">
    @csrf
    @method('POST')

    <label for="title">Title</label>
    <input class="form-control" type="text" name="title" value="{{ $task->title }}" required>
    <input type="hidden" name="id" value="{{ $task->id }}">
    <label for="description">Description</label>
    <textarea class="form-control"  name="description" required>{{ $task->description }}</textarea>

    <label for="priority">Priority</label>
    <select class="form-control"  name="priority" required>
        <option value="Low" {{ $task->priority == 'Low' ? 'selected' : '' }}>Low</option>
        <option value="Medium" {{ $task->priority == 'Medium' ? 'selected' : '' }}>Medium</option>
        <option value="High" {{ $task->priority == 'High' ? 'selected' : '' }}>High</option>
    </select>

    <label for="due_date">Due Date</label>
    <input class="form-control" type="date" name="due_date" value="{{ $task->due_date }}" required>

    <label for="status">Status</label>
    <select class="form-control"  name="status" required>
        <option value="To Do" {{ $task->status == 'To Do' ? 'selected' : '' }}>To Do</option>
        <option value="In Progress" {{ $task->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
        <option value="Under Review" {{ $task->status == 'Under Review' ? 'selected' : '' }}>Under Review</option>
        <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>Completed</option>
    </select>

    <label for="attachment">Attachment</label>
    <input class="form-control"  type="file" name="attachment" accept=".jpg,.jpeg,.png,.pdf,.docx">

    @if ($task->attachment)
        <p>Current Attachment: <a href="{{ asset('storage/' . $task->attachment) }}" target="_blank">View File</a></p>
    @endif

    <button class="form-control btn btn-primary" type="submit">Update Task</button>
</form>
</div>

@endsection
