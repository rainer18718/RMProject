@extends('layouts.app')

@section('title', 'View Degree')

@section('content')
    <h1>Degree Details</h1>

    <div class="card">
        <p><strong>ID:</strong> {{ $degree->id }}</p>
        <p><strong>Degree Title:</strong> {{ $degree->degree_title }}</p>
        <p><strong>Created At:</strong> {{ $degree->created_at->format('M d, Y h:i A') }}</p>
        <p><strong>Updated At:</strong> {{ $degree->updated_at->format('M d, Y h:i A') }}</p>
    </div>

    <br>

    <a href="/degrees" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>Back to List</a>
    <a href="/degrees/{{ $degree->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-square"></i>Edit</a>
@endsection
