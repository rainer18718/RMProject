@extends('layouts.app')

@section('title', 'Degree List')

@section('content')
    <h1>Degree List</h1>

    <a href="/degrees/create" class="btn btn-primary"><i class="bi bi-plus-circle"></i>Add New Degree</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Degree Title</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($degrees as $degree)
                <tr>
                    <td>{{ $degree->id }}</td>
                    <td>{{ $degree->degree_title }}</td>
                    <td>{{ $degree->created_at->format('M d, Y h:i A') }}</td>
                    <td>
                        <div class="actions">
                            <a href="/degrees/{{ $degree->id }}" class="btn btn-success"><i class="bi bi-eye"></i>View</a>
                            <a href="/degrees/{{ $degree->id }}/edit" class="btn btn-warning"><i class="bi bi-pencil-square"></i>Edit</a>

                            <form action="/degrees/{{ $degree->id }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this degree?')"><i class="bi bi-trash"></i>Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No degree records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $degrees->links() }}
    </div>
@endsection
