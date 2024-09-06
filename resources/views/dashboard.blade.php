@extends('layouts.app')

@section('content')

    <!-- Dashboard Content -->
    <div class="container my-5">
        <h2 class="text-light text-center mb-5"></h2>

        <div class="row">
            <!-- Total Tasks -->
            <div class="col-md-3 mb-4">
                <a href="{{ route('tasks.index') }}" class="text-decoration-none">
                    <div class="card bg-gradient-dark border-0 shadow-lg h-100 text-light hover-card">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                            <h3 class="card-title">{{ $totalTasks }}</h3>
                            <p class="card-text">Total Tasks</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Completed Tasks -->
            <div class="col-md-3 mb-4">
                <a href="{{ route('tasks.index', ['status' => 'completed']) }}" class="text-decoration-none">
                    <div class="card bg-gradient-success border-0 shadow-lg h-100 text-light hover-card">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                            <h3 class="card-title">{{ $completedTasks }}</h3>
                            <p class="card-text">Completed Tasks</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Overdue Tasks -->
            <div class="col-md-3 mb-4">
                <a href="{{ route('tasks.index', ['status' => 'overdue']) }}" class="text-decoration-none">
                    <div class="card bg-gradient-danger border-0 shadow-lg h-100 text-light hover-card">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                            <h3 class="card-title">{{ $overdueTasks }}</h3>
                            <p class="card-text">Overdue Tasks</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Task Completion Percentage -->
            <div class="col-md-3 mb-4">
                <div class="text-decoration-none">
                    <div class="card bg-gradient-primary border-0 shadow-lg h-100 text-light hover-card">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                            <h3 class="card-title">{{ number_format($completionPercentage, 2) }}%</h3>
                            <p class="card-text">Task Completion Rate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tasks by Priority -->
        <h3 class="text-light mt-4 text-center"></h3>
        <div class="row">
            @foreach($tasksByPriority as $priority)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('tasks.index', ['priority' => $priority->priority]) }}" class="text-decoration-none">
                        <div class="card bg-gradient-secondary border-0 shadow-lg h-100 text-light hover-card">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
                                <h3 class="card-title">{{ $priority->count }}</h3>
                                <p class="card-text">{{ $priority->priority }} Priority</p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Additional Styling for Hover Effects -->
    <style>
        .hover-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .hover-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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
        .text-light {
            color: #f8f9fa !important;
        }
        .text-light a {
            color: #f8f9fa !important;
        }
        .text-light a:hover {
            color: #e9ecef !important;
            text-decoration: none;
        }
    </style>
@endsection
