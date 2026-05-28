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
                <th>Actions</th>
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
                    <td>
                        <div class="actions">
                            <a href="{{ route('teachers.show', $teacher) }}" class="btn btn-secondary"><i class="bi bi-eye"></i>View</a>
                            <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i>Edit</a>
                            <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" onsubmit="return confirm('Delete this teacher account?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i>Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No teacher accounts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $teachers->links() }}
    </div>
@endsection
