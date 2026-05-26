@extends('layouts.app')

@section('title', 'Add Degree')

@section('content')
    <h1>Add New Degree</h1>

    @if ($errors->any())
        <div class="alert" style="background:#fee2e2; color:#991b1b;">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/degrees" method="POST">
        @csrf

        <label for="degree_title">Degree Title</label>
        <input type="text" name="degree_title" id="degree_title" value="{{ old('degree_title') }}" placeholder="Enter degree title">

        <button type="submit" class="btn btn-primary">Save Degree</button>
        <a href="/degrees" class="btn btn-secondary">Back</a>
    </form>
@endsection
