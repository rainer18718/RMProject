@extends('layouts.app')

@section('title', 'Teacher Details')

@section('content')
    <h1>Teacher Details</h1>

    <div class="card">
        <p><strong>ID:</strong> {{ $teacher->id }}</p>
        <p><strong>Username:</strong> {{ $teacher->username }}</p>
        <p><strong>Email:</strong> {{ $teacher->email }}</p>
        <p><strong>Status:</strong> {{ $teacher->is_active ? 'Active' : 'Inactive' }}</p>
        <p><strong>Created At:</strong> {{ $teacher->created_at?->format('M d, Y h:i A') }}</p>
        <p><strong>Updated At:</strong> {{ $teacher->updated_at?->format('M d, Y h:i A') }}</p>
    </div>

    <br>

    <a href="{{ route('teachers.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>Back</a>
    <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i>Edit</a>
@endsection
