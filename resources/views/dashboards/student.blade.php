@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
    <style>
        .student-console {
            display: grid;
            gap: 16px;
        }

        .student-hero-new {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 250px;
            gap: 18px;
            align-items: stretch;
            padding: clamp(22px, 4vw, 34px);
            border-radius: 8px;
            background:
                linear-gradient(135deg, rgba(19, 35, 58, 0.95), rgba(15, 118, 110, 0.86) 58%, rgba(183, 121, 31, 0.78)),
                url("https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=1400&q=80") center/cover;
            border: 1px solid rgba(19, 35, 58, 0.14);
            box-shadow: 0 18px 42px rgba(19, 35, 58, 0.20);
            color: #ffffff;
        }

        .student-hero-new h1 {
            margin: 8px 0 10px;
            color: #ffffff !important;
            font-size: clamp(32px, 4vw, 46px);
        }

        .student-hero-new p {
            max-width: 650px;
            margin: 0;
            color: #f1f7f6 !important;
        }

        .student-label,
        .student-panel-title span {
            color: #ffd9c9 !important;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .student-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .student-badge-new {
            display: grid;
            align-content: center;
            gap: 8px;
            padding: 18px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.22);
        }

        .student-badge-new i {
            font-size: 30px;
            color: #ffd9c9;
        }

        .student-badge-new strong {
            color: #ffffff;
            font-size: 20px;
        }

        .student-badge-new span {
            color: #f1f7f6;
            font-weight: 850;
        }

        .student-main-new {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 310px;
            gap: 16px;
            align-items: start;
        }

        .student-panel-new,
        .student-side-new {
            border: 1px solid #d9e1ea;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 16px 36px rgba(23, 32, 51, 0.10);
            padding: 22px;
        }

        .student-panel-title {
            margin-bottom: 16px;
        }

        .student-panel-title span {
            color: #d85a3a !important;
        }

        .student-panel-title h2 {
            margin: 5px 0 0;
            color: #172033 !important;
        }

        .student-detail-grid-new {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .student-detail-new {
            display: grid;
            grid-template-columns: 44px minmax(0, 1fr);
            gap: 12px;
            align-items: center;
            min-height: 98px;
            padding: 16px;
            border-radius: 8px;
            background: #f8faf7;
            border: 1px solid #d9e1ea;
        }

        .student-detail-new i,
        .student-side-new > i,
        .student-empty-new i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 8px;
            background: #e8f3ef;
            color: #0f766e;
            font-size: 20px;
        }

        .student-detail-new span {
            display: block;
            color: #d85a3a;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .student-detail-new strong {
            display: block;
            margin-top: 4px;
            color: #172033;
            word-break: break-word;
        }

        .student-side-new {
            display: grid;
            gap: 12px;
            background: #f8faf7;
        }

        .student-side-new h2 {
            margin: 0;
            color: #172033 !important;
        }

        .student-side-new p {
            margin: 0;
            color: #667085 !important;
        }

        .student-empty-new {
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 18px;
            border-radius: 8px;
            background: #f8faf7;
            border: 1px solid #d9e1ea;
        }

        .student-empty-new p {
            margin: 0;
            color: #344054 !important;
            font-weight: 850;
        }

        .student-export-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 16px;
        }

        @media (max-width: 900px) {
            .student-hero-new,
            .student-main-new,
            .student-detail-grid-new {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="student-console">
        <header class="student-hero-new">
            <div>
                <span class="student-label"><i class="bi bi-mortarboard-fill"></i>Student Portal</span>
                <h1>Academic Profile</h1>
                <p>View your student information, degree connection, and account status in one focused dashboard.</p>
            </div>

            <aside class="student-badge-new">
                <i class="bi bi-person-check-fill"></i>
                <strong>{{ $student ? 'Profile Linked' : 'Profile Pending' }}</strong>
                <span>Student Access</span>
            </aside>
        </header>

        <div class="student-main-new">
            <section class="student-panel-new">
                <div class="student-panel-title">
                    <span>Profile Details</span>
                    <h2>Student Information</h2>
                </div>

                @if($student)
                    <div class="student-detail-grid-new">
                        <div class="student-detail-new">
                            <i class="bi bi-hash"></i>
                            <div><span>Student ID</span><strong>{{ $student->student_id }}</strong></div>
                        </div>
                        <div class="student-detail-new">
                            <i class="bi bi-person-fill"></i>
                            <div><span>Name</span><strong>{{ $student->first_name }} {{ $student->last_name }}</strong></div>
                        </div>
                        <div class="student-detail-new">
                            <i class="bi bi-envelope-fill"></i>
                            <div><span>Email</span><strong>{{ $student->email }}</strong></div>
                        </div>
                        <div class="student-detail-new">
                            <i class="bi bi-award-fill"></i>
                            <div><span>Degree</span><strong>{{ $student->degree->degree_title ?? 'No Degree' }}</strong></div>
                        </div>
                    </div>
                @else
                    <div class="student-empty-new">
                        <i class="bi bi-info-circle-fill"></i>
                        <p>No student profile is linked to this account yet.</p>
                    </div>
                @endif

                <div class="student-export-actions">
                    <a class="btn btn-primary" href="{{ route('dashboards.export.pdf', 'student') }}" target="_blank"><i class="bi bi-file-earmark-pdf"></i>Generate PDF</a>
                    <a class="btn btn-success" href="{{ route('dashboards.export.excel', 'student') }}"><i class="bi bi-file-earmark-spreadsheet"></i>Export to Excel</a>
                </div>
            </section>

            <aside class="student-side-new">
                <i class="bi bi-patch-check-fill"></i>
                <h2>Account Status</h2>
                <p>{{ $student ? 'Your student profile is connected and ready.' : 'Please ask an admin to connect your student profile.' }}</p>
            </aside>
        </div>
    </section>
@endsection
