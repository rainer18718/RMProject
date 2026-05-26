@extends('layouts.app')

@section('title', 'Add Teacher')

@section('content')
    <section class="form-hero teacher-form-theme">
        <div>
            <span class="eyebrow">Teacher Registration</span>
            <h1>Add New Teacher</h1>
            <p>Create a secure teacher account with active role access.</p>
        </div>

        <a href="{{ route('teachers.index') }}" class="hero-link">
            <i class="bi bi-arrow-left"></i>
            Back to Teachers
        </a>
    </section>

    <div class="form-workspace">
        <section class="form-card">
            <div class="panel-title">
                <span>Teacher Account</span>
                <h2>Teacher Details</h2>
            </div>

            @if ($errors->any())
                <div class="form-errors">
                    <strong>Please check the following:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('teachers.store') }}" method="POST" class="modern-form">
                @csrf

                <div class="form-grid single-row">
                    <div class="field-group">
                        <label for="username">Username</label>
                        <div class="field-control">
                            <i class="bi bi-at"></i>
                            <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Create username">
                        </div>
                    </div>

                    <div class="field-group">
                        <label for="email">Email</label>
                        <div class="field-control">
                            <i class="bi bi-envelope"></i>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="teacher@email.com">
                        </div>
                    </div>

                    <div class="field-group full-span">
                        <label for="password">Password</label>
                        <div class="field-control">
                            <i class="bi bi-lock"></i>
                            <input type="password" name="password" id="password" placeholder="Minimum 8 characters">
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2"></i>Save Teacher</button>
                    <a href="{{ route('teachers.index') }}" class="btn btn-secondary"><i class="bi bi-x"></i>Cancel</a>
                </div>
            </form>
        </section>

        <aside class="form-side-card teacher-card">
            <i class="bi bi-person-badge"></i>
            <h2>Teacher access</h2>
            <p>Teacher accounts are saved with teacher role access and active status.</p>
        </aside>
    </div>
@endsection
