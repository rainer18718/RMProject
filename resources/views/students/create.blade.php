@extends('layouts.app')

@section('title', 'Add Student')

@section('content')
    <section class="student-studio-interface">
        <header class="studio-topbar">
            <a href="/students" class="studio-back">
                <i class="bi bi-arrow-left"></i>
                Students
            </a>

            <div>
                <span>Enrollment Studio</span>
                <h1>Add New Student</h1>
            </div>

            <div class="studio-pill">
                <i class="bi bi-shield-check"></i>
                Admin Entry
            </div>
        </header>

        <div class="studio-grid">
            <section class="studio-form-card">
                <div class="studio-heading">
                    <span>Student Profile</span>
                    <h2>Complete the enrollment details</h2>
                    <p>Fill out the student identity, contact information, and login credentials below.</p>
                </div>

                @if ($errors->any())
                    <div class="form-errors studio-errors">
                        <strong>Please check the following:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/students" method="POST" class="studio-form">
                    @csrf

                    <div class="studio-section">
                        <div class="studio-section-label">
                            <i class="bi bi-person-lines-fill"></i>
                            Identity
                        </div>

                        <div class="form-grid studio-field-grid">
                            <div class="field-group">
                                <label for="student_id">Student ID</label>
                                <div class="field-control">
                                    <i class="bi bi-hash"></i>
                                    <input type="text" name="student_id" id="student_id" value="{{ old('student_id') }}" placeholder="e.g. 2026-001">
                                </div>
                            </div>

                            <div class="field-group">
                                <label for="degree_id">Degree</label>
                                <div class="field-control">
                                    <i class="bi bi-mortarboard"></i>
                                    <select name="degree_id" id="degree_id">
                                        <option value="">Select degree</option>
                                        @foreach($degrees as $degree)
                                            <option value="{{ $degree->id }}" {{ old('degree_id') == $degree->id ? 'selected' : '' }}>
                                                {{ $degree->degree_title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="field-group">
                                <label for="first_name">First Name</label>
                                <div class="field-control">
                                    <i class="bi bi-person"></i>
                                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="Enter first name">
                                </div>
                            </div>

                            <div class="field-group">
                                <label for="last_name">Last Name</label>
                                <div class="field-control">
                                    <i class="bi bi-person"></i>
                                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Enter last name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="studio-section">
                        <div class="studio-section-label">
                            <i class="bi bi-chat-square-text"></i>
                            Contact
                        </div>

                        <div class="form-grid studio-field-grid">
                            <div class="field-group full-span">
                                <label for="address">Address</label>
                                <div class="field-control">
                                    <i class="bi bi-geo-alt"></i>
                                    <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Enter complete address">
                                </div>
                            </div>

                            <div class="field-group">
                                <label for="contact_number">Contact Number</label>
                                <div class="field-control">
                                    <i class="bi bi-phone"></i>
                                    <input type="text" name="contact_number" id="contact_number" value="{{ old('contact_number') }}" inputmode="numeric" placeholder="11-digit mobile number">
                                </div>
                            </div>

                            <div class="field-group">
                                <label for="email">Email</label>
                                <div class="field-control">
                                    <i class="bi bi-envelope"></i>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="student@email.com">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="studio-section">
                        <div class="studio-section-label">
                            <i class="bi bi-key"></i>
                            Account
                        </div>

                        <div class="form-grid studio-field-grid">
                            <div class="field-group">
                                <label for="username">Username</label>
                                <div class="field-control">
                                    <i class="bi bi-at"></i>
                                    <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Create username">
                                </div>
                            </div>

                            <div class="field-group">
                                <label for="password">Password</label>
                                <div class="field-control">
                                    <i class="bi bi-lock"></i>
                                    <input type="password" name="password" id="password" placeholder="Minimum 8 characters">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="studio-actions">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check2"></i>Save Student</button>
                        <a href="/students" class="btn btn-secondary"><i class="bi bi-x"></i>Cancel</a>
                    </div>
                </form>
            </section>

            <aside class="studio-side-panel">
                <div class="studio-side-icon">
                    <i class="bi bi-stars"></i>
                </div>
                <h2>Before Saving</h2>
                <p>Confirm the student's degree, email, contact number, and account login before creating the record.</p>

                <div class="studio-checklist">
                    <div><i class="bi bi-check2-circle"></i>Degree selected</div>
                    <div><i class="bi bi-check2-circle"></i>Email is valid</div>
                    <div><i class="bi bi-check2-circle"></i>Contact number has 11 digits</div>
                </div>
            </aside>
        </div>
    </section>
@endsection
