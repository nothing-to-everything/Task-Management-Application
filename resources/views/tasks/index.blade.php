@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <!-- Header with buttons -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-light">Your Tasks</h2>
            <div>
                <a href="{{ route('tasks.create') }}" class="btn btn-gradient">+ Create Task</a>
            </div>
        </div>

        <!-- Flash message for success -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Search and Filter Form -->
        <div class="card bg-dark text-light border-0 shadow-lg mb-4">
            <div class="card-body">
                <form action="{{ route('tasks.index') }}" method="GET">
                    <div class="row">
                        <!-- Search Input -->
                        <div class="col-md-4 mb-3">
                            <input type="text" name="search" class="form-control" placeholder="Search tasks..." value="{{ request('search') }}">
                        </div>

                        <!-- Priority Filter -->
                        <div class="col-md-3 mb-3">
                            <select name="priority" class="form-control">
                                <option value="All" {{ request('priority') == 'All' ? 'selected' : '' }}>All Priorities</option>
                                <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                                <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>High</option>
                            </select>
                        </div>

                        <!-- Due Date Filter -->
                        <div class="col-md-3 mb-3">
                            <input type="date" name="due_date" class="form-control" value="{{ request('due_date') }}">
                        </div>

                        <!-- Filter Button -->
                        <div class="col-md-2 mb-3">
                            <button type="submit" class="btn btn-gradient btn-block">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Task List -->
        @if(isset($tasks) && $tasks->count() > 0)
            <div class="card bg-dark text-light border-0 shadow-lg">
                <div class="card-body p-0">
                    <table class="table table-dark table-striped mb-0">
                        <thead class="thead-dark">
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Due Date</th>
                            <th>Priority</th>
                            <th>Category</th>
                            <th>Completed</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tasks as $task)
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ $task->priority }}</td>
                                <td>{{ $task->category }}</td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" class="task-completed" data-task-id="{{ $task->id }}" {{ $task->completed ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td>
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <p class="text-center text-light">No tasks available. <a href="{{ route('tasks.create') }}" class="text-info">Create a task</a></p>
        @endif
    </div>

    <!-- JavaScript for AJAX -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const switchElements = document.querySelectorAll('.task-completed');

            switchElements.forEach(switchElement => {
                switchElement.addEventListener('change', function() {
                    const taskId = this.getAttribute('data-task-id');
                    const completed = this.checked;

                    fetch(`/tasks/${taskId}/update-status`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ completed })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Task status updated successfully');
                            } else {
                                console.error('Error updating task status');
                                this.checked = !completed; // Revert the switch if the update failed
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            this.checked = !completed; // Revert the switch if the update failed
                        });
                });
            });
        });
    </script>

    <!-- Meta tag for CSRF token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
