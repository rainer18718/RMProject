@extends('layouts.app')

@section('title', 'Teacher List')

@section('content')
    <h1>Teacher List</h1>

    <a href="{{ route('teachers.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i>Add New Teacher</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Status</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teachers as $teacher)
                <tr>
                    <td>{{ $teacher->id }}</td>
                    <td>{{ $teacher->username }}</td>
                    <td>{{ $teacher->email }}</td>
                    <td>{{ $teacher->is_active ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $teacher->created_at?->format('M d, Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No teacher accounts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $teachers->links() }}
    </div>
@endsection
