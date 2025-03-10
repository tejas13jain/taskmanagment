@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Sub Task</h2>
   
    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>End Date</th>
                <!-- <th>Actions</th>/ -->
            </tr>
        </thead>
        <tbody>
            @foreach($task as $project)
            <tr>
                <td>{{ $project->title }}</td>
                <td>{{ $project->description}}</td>
                <td>
                <select class="form-control" name="priority" id="prioritySelect" data-project-id="{{ $project->id }}" required>
                    <option value="In Progress" {{ $project->priority == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Hold" {{ $project->priority == 'Hole' ? 'selected' : '' }}>Hold</option>
                    <option value="Completed" {{ $project->priority == 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>    
                </td>
                <td>{{ $project->due_date }}</td>
               
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#prioritySelect').change(function() {
            let projectId = $(this).data('project-id');
            let newPriority = $(this).val();
          
            $.ajax({
                url: '/projects/' + projectId + '/update-priority',
                type: 'PUT',
                data: {
                    _token: '{{ csrf_token() }}',
                    priority: newPriority,
                    projects_id: projectId
                },
                success: function(response) {
                    alert(response.message);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });
</script>
@endsection
