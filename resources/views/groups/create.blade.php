@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Group</h2>
    <form action="{{ route('groups.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Assign Users:</label>
            <select name="users[]" class="form-control" multiple>
                @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>
</div>
@endsection
