@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="container">
                    @auth
                        <h2>Welcome, {{ Auth::user()->name }}</h2>
                        <p>Your role: {{ Auth::user()->role_id }}</p>
                    @else
                        <h2>Welcome, Guest</h2>
                        <p>Please <a href="{{ route('login') }}">log in</a>.</p>
                    @endauth
                </div>

                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::check() && Auth::user()->role_id == "admin")
                        <a href="{{ route('projects.index') }}" class="btn btn-primary">Projects</a>
                        <a href="/groupsDashboard" class="btn btn-success">Create Groups</a>
                        <a href="/taskDashboard" class="btn btn-warning">Add Task</a>
                    @else
                        <a href="/user_Task" class="btn btn-primary">User Project Dashboard</a>
                    @endif


                    <br>
                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>

git remote add origin 
<div class="container">
    <h2 class="mb-4">Dashboard</h2>

    <!-- Task Overview Section -->
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Assigned Tasks</h5>
                    <h3>{{ $assignedTasks }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Completed Tasks</h5>
                    <h3>{{ $completedTasks }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Pending Tasks</h5>
                    <h3>{{ $pendingTasks }}</h3>
                </div>
            </div>
        </div>
    </div>

  
    <!-- Project Progress Tracking -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Project Progress</div>
                <div class="card-body">
                    @foreach ($projects as $project)
                        <h5>{{ $project->name }}</h5>
                        <div class="progress mb-3">
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{ $project->progress }}%;" aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100">
                                {{ $project->progress }}%
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
