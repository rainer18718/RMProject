@extends('layouts.app')

@section('title', 'Edit Degree')

@section('content')
    <h1>Edit Degree</h1>

    @if ($errors->any())
        <div class="alert" style="background:#fee2e2; color:#991b1b;">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/degrees/{{ $degree->id }}" method="POST">
        @csrf
        @method('PUT')

        <label for="degree_title">Degree Title</label>
        <input type="text" name="degree_title" id="degree_title" value="{{ old('degree_title', $degree->degree_title) }}">

        <button type="submit" class="btn btn-primary">Update Degree</button>
        <a href="/degrees" class="btn btn-secondary">Back</a>
    </form>
@endsection
