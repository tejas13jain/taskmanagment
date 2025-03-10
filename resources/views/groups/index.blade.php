@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Group List</h2>
    <a href="{{ route('groups.create') }}" class="btn btn-primary">Create Group</a>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($groups as $group)
            <tr>
                <td>{{ $group->name }}</td>
                <td>{{ $group->description }}</td>
                <td>
                    <a href="{{ route('groups.edit', $group->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('groups.destroy', $group->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
