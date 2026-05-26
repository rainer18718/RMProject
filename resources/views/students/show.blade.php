@extends('layouts.app')

@section('title', 'Student Details')

@section('content')
    <h1>Student Details</h1>

    <div class="card">
        <p><strong>ID:</strong> {{ $student->id }}</p>
        <p><strong>User Account ID:</strong> {{ $student->user_account_id ?? 'No Account' }}</p>
        <p><strong>Username:</strong> {{ $student->userAccount->username ?? 'No Account' }}</p>
        <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
        <p><strong>First Name:</strong> {{ $student->first_name }}</p>
        <p><strong>Last Name:</strong> {{ $student->last_name }}</p>
        <p><strong>Address:</strong> {{ $student->address }}</p>
        <p><strong>Contact Number:</strong> {{ $student->contact_number }}</p>
        <p><strong>Email:</strong> {{ $student->email }}</p>
        <p><strong>Degree:</strong> {{ $student->degree->degree_title ?? 'No Degree' }}</p>
        <p><strong>Created At:</strong> {{ $student->created_at->format('M d, Y h:i A') }}</p>
        <p><strong>Updated At:</strong> {{ $student->updated_at->format('M d, Y h:i A') }}</p>
    </div>

    <br>

    <a href="/students" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>Back to List</a>
    <a href="/students/{{ $student->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-square"></i>Edit</a>
@endsection
