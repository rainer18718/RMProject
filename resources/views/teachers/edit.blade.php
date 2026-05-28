@extends('layouts.app')

@section('title', 'Edit Teacher')

@section('content')
    <h1>Edit Teacher</h1>

    @if ($errors->any())
        <div class="alert alert-error">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('teachers.update', $teacher) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="{{ old('username', $teacher->username) }}">

        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ old('email', $teacher->email) }}">

        <label for="password">New Password</label>
        <input type="password" name="password" id="password" placeholder="Leave blank to keep current password">

        <label>
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $teacher->is_active) ? 'checked' : '' }} style="width:auto; margin-right:8px;">
            Active account
        </label>

        <button type="submit" class="btn btn-primary"><i class="bi bi-check2"></i>Update Teacher</button>
        <a href="{{ route('teachers.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i>Back</a>
    </form>
@endsection
