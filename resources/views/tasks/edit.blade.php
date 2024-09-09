@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h2 class="text-light mb-4">Edit Task</h2>

        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="form-group mb-4">
                <label for="title" class="text-light">Title</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $task->title) }}" required>
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group mb-4">
                <label for="description" class="text-light">Description</label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $task->description) }}</textarea>
                @error('description')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Category -->
            <div class="form-group mb-4">
                <label for="category" class="text-light">Category</label>
                <input type="text" name="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $task->category) }}">
                @error('category')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Due Date -->
            <div class="form-group mb-4">
                <label for="due_date" class="text-light">Due Date</label>
                <input type="date" name="due_date" class="form-control @error('due_date') is-invalid @enderror" value="{{ old('due_date', $task->due_date) }}">
                @error('due_date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Priority -->
            <div class="form-group mb-4">
                <label for="priority" class="text-light">Priority</label>
                <select name="priority" class="form-control @error('priority') is-invalid @enderror">
                    <option value="Low" {{ old('priority', $task->priority) == 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ old('priority', $task->priority) == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ old('priority', $task->priority) == 'High' ? 'selected' : '' }}>High</option>
                </select>
                @error('priority')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-gradient">Update Task</button>
        </form>
    </div>
@endsection
