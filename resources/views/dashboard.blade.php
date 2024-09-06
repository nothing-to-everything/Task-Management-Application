@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-light text-center mb-5">Task Dashboard</h2>

        <div class="row text-light">
            <!-- Total Tasks -->
            <div class="col-md-3">
                <a href="{{ route('tasks.index') }}" class="text-decoration-none">
                    <div class="card bg-gradient-dark border-0 shadow-lg mb-4 hover-card">
                        <div class="card-body text-center">
                            <h3>{{ $totalTasks }}</h3>
                            <p>Total Tasks</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Completed Tasks -->
            <div class="col-md-3">
                <a href="{{ route('tasks.index', ['status' => 'completed']) }}" class="text-decoration-none">
                    <div class="card bg-gradient-success border-0 shadow-lg mb-4 hover-card">
                        <div class="card-body text-center">
                            <h3>{{ $completedTasks }}</h3>
                            <p>Completed Tasks</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Overdue Tasks -->
            <div class="col-md-3">
                <a href="{{ route('tasks.index', ['status' => 'overdue']) }}" class="text-decoration-none">
                    <div class="card bg-gradient-danger border-0 shadow-lg mb-4 hover-card">
                        <div class="card-body text-center">
                            <h3>{{ $overdueTasks }}</h3>
                            <p>Overdue Tasks</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Task Completion Percentage -->
            <div class="col-md-3">
                <a href="{{ route('tasks.index') }}" class="text-decoration-none">
                    <div class="card bg-gradient-primary border-0 shadow-lg mb-4 hover-card">
                        <div class="card-body text-center">
                            <h3>{{ number_format($completionPercentage, 2) }}%</h3>
                            <p>Task Completion Rate</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Tasks by Priority -->
        <h3 class="text-light mt-4 text-center">Tasks by Priority</h3>
        <div class="row text-light">
            @foreach($tasksByPriority as $priority)
                <div class="col-md-3">
                    <a href="{{ route('tasks.index', ['priority' => $priority->priority]) }}" class="text-decoration-none">
                        <div class="card bg-gradient-secondary border-0 shadow-lg mb-4 hover-card">
                            <div class="card-body text-center">
                                <h3>{{ $priority->count }}</h3>
                                <p>{{ $priority->priority }} Priority</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Additional Styling for Hover Effects -->
    <style>
        .hover-card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
        .bg-gradient-dark {
            background: linear-gradient(135deg, #1f1f1f, #292929);
        }
        .bg-gradient-success {
            background: linear-gradient(135deg, #28a745, #218838);
        }
        .bg-gradient-danger {
            background: linear-gradient(135deg, #dc3545, #c82333);
        }
        .bg-gradient-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
        }
        .bg-gradient-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
        }
        .text-decoration-none {
            color: white !important;
        }
        .text-decoration-none:hover {
            color: #f8f9fa !important;
            text-decoration: none;
        }
    </style>
@endsection
