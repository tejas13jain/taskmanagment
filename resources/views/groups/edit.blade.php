@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Group</h2>
    <form action="{{ route('groups.update', $group->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" class="form-control" value="{{ $group->name }}" required>
        </div>

       
        <div class="form-group">
            <label>Assign Users:</label>
            <select name="users[]" class="form-control" multiple>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $group->users->contains($user->id) ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning mt-2">Update</button>
    </form>
</div>
@endsection
