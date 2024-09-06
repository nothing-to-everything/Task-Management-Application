@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Your Tasks</h2>

        <!-- Flash message for success -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Task Filtering Form -->
        <form action="{{ route('tasks.index') }}" method="GET" class="mb-4">
            <div class="form-row">
                <!-- Priority Filter -->
                <div class="col">
                    <select name="priority" class="form-control">
                        <option value="All" {{ request('priority') == 'All' ? 'selected' : '' }}>All Priorities</option>
                        <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>High</option>
                    </select>
                </div>

                <!-- Due Date Filter -->
                <div class="col">
                    <input type="date" name="due_date" class="form-control" value="{{ request('due_date') }}">
                </div>

                <!-- Filter Button -->
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Task List -->
        @if($tasks->count() > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Priority</th>
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
                        <td>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No tasks available.</p>
        @endif
    </div>
@endsection
