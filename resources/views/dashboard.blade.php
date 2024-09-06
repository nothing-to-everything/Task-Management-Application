@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Task Dashboard</h2>

        <div class="row">
            <!-- Total Tasks -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Total Tasks</h4>
                        <p class="card-text">{{ $totalTasks }}</p>
                    </div>
                </div>
            </div>

            <!-- Completed Tasks -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Completed Tasks</h4>
                        <p class="card-text">{{ $completedTasks }}</p>
                    </div>
                </div>
            </div>

            <!-- Overdue Tasks -->
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title">Overdue Tasks</h4>
                        <p class="card-text">{{ $overdueTasks }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks by Priority -->
        <h3>Tasks by Priority</h3>
        <div class="row">
            @foreach($priorityCounts as $priority => $count)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title">{{ $priority }}</h4>
                            <p class="card-text">{{ $count }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
