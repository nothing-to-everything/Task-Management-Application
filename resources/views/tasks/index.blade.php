@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Your Tasks</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">Create New Task</a>

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
