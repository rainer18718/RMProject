@extends('layouts.app')

@section('title', 'Edit Student')

@section('content')
    <h1>Edit Student</h1>



    <form action="/students/{{ $student->id }}" method="POST">
        @csrf
        @method('PUT')

        <label for="student_id">Student ID</label>
        <input type="text" name="student_id" id="student_id" value="{{ old('student_id', $student->student_id) }}">
        @error('student_id')
            <div class="error" style="color:#991b1b;">{{ $message }}</div>
        @enderror

        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $student->first_name) }}">
            @error('first_name')
                <div class="error" style="color:#991b1b;">{{ $message }}</div>
            @enderror
        <label for="last_name">Last Name</label>
        <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $student->last_name) }}">
            @error('last_name')
                <div class="error" style="color:#991b1b;">{{ $message }}</div>
            @enderror
        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="{{ old('address', $student->address) }}">
                @error('address')
                    <div class="error" style="color:#991b1b;">{{ $message }}</div>
                @enderror
        <label for="contact_number">Contact Number</label>
        <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number', $student->contact_number) }}" inputmode="numeric">
                @error('contact_number')
                    <div class="error" style="color:#991b1b;">{{ $message }}</div>
                @enderror
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $student->email) }}">
                @error('email')
                    <div class="error" style="color:#991b1b;">{{ $message }}</div>
                @enderror
        <label for="degree_id">Degree</label>
        <select name="degree_id" id="degree_id">
            <option value="">-- Select Degree --</option>
            @foreach($degrees as $degree)
                <option value="{{ $degree->id }}"
                    {{ old('degree_id', $student->degree_id) == $degree->id ? 'selected' : '' }}>
                    {{ $degree->degree_title }}
                </option>
            @endforeach
        </select>
        

        <button type="submit" class="btn btn-primary">Update Student</button>
        <a href="/students" class="btn btn-secondary">Back</a>
    </form>

        @if ($errors->any())
        <div class="alert" style="background:#fee2e2; color:#991b1b;">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
