@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <style>
        .admin-console {
            display: grid;
            gap: 16px;
        }

        .admin-console * {
            letter-spacing: 0;
        }

        .admin-hero-new {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 250px;
            gap: 18px;
            align-items: stretch;
            padding: clamp(22px, 4vw, 34px);
            border-radius: 8px;
            background:
                linear-gradient(135deg, rgba(19, 35, 58, 0.96), rgba(15, 118, 110, 0.88) 58%, rgba(216, 90, 58, 0.84)),
                url("https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=1400&q=80") center/cover;
            border: 1px solid rgba(19, 35, 58, 0.14);
            box-shadow: 0 18px 42px rgba(19, 35, 58, 0.20);
            color: #ffffff;
        }

        .admin-hero-new h1 {
            margin: 8px 0 10px;
            color: #ffffff !important;
            font-size: clamp(32px, 4vw, 46px);
        }

        .admin-hero-new p {
            max-width: 660px;
            margin: 0;
            color: #f1f7f6 !important;
        }

        .dash-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ffd9c9 !important;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .admin-today-card {
            display: grid;
            align-content: center;
            gap: 8px;
            padding: 18px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.22);
        }

        .admin-today-card i {
            color: #ffd9c9;
            font-size: 28px;
        }

        .admin-today-card strong {
            color: #ffffff;
            font-size: 20px;
        }

        .admin-today-card span {
            color: #f1f7f6;
            font-weight: 850;
        }

        .admin-stat-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .admin-stat,
        .admin-panel-new {
            border: 1px solid #d9e1ea;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 16px 36px rgba(23, 32, 51, 0.10);
        }

        .admin-stat {
            display: grid;
            grid-template-columns: 48px minmax(0, 1fr);
            gap: 14px;
            align-items: center;
            padding: 18px;
        }

        .admin-stat i,
        .admin-action-new i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 8px;
            background: #e8f3ef;
            color: #0f766e;
            font-size: 22px;
        }

        .admin-stat span,
        .panel-title-new span {
            color: #d85a3a;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .admin-stat strong {
            display: block;
            margin-top: 4px;
            color: #172033;
            font-size: 32px;
            line-height: 1;
        }

        .admin-work-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 310px;
            gap: 16px;
            align-items: start;
        }

        .admin-panel-new {
            padding: 22px;
        }

        .panel-title-new {
            margin-bottom: 16px;
        }

        .panel-title-new h2 {
            margin: 5px 0 0;
            color: #172033 !important;
        }

        .admin-actions-new {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .admin-action-new {
            display: grid;
            grid-template-columns: 48px minmax(0, 1fr);
            gap: 14px;
            align-items: center;
            min-height: 112px;
            padding: 16px;
            border-radius: 8px;
            background: #f8faf7;
            border: 1px solid #d9e1ea;
            color: #172033;
            text-decoration: none;
        }

        .admin-action-new:hover {
            border-color: #0f766e;
            box-shadow: 0 12px 26px rgba(15, 118, 110, 0.13);
        }

        .admin-action-new strong {
            color: #172033;
            font-size: 16px;
        }

        .admin-action-new span {
            display: block;
            margin-top: 4px;
            color: #667085;
            font-size: 13px;
            line-height: 1.45;
        }

        .admin-check-list {
            display: grid;
            gap: 12px;
        }

        .admin-check-list div {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            padding: 12px;
            border-radius: 8px;
            background: #f8faf7;
            color: #344054;
            font-weight: 850;
            line-height: 1.4;
        }

        .admin-check-list i {
            color: #0f766e;
            margin-top: 2px;
        }

        @media (max-width: 900px) {
            .admin-hero-new,
            .admin-stat-grid,
            .admin-work-grid,
            .admin-actions-new {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="admin-console">
        <header class="admin-hero-new">
            <div>
                <span class="dash-label"><i class="bi bi-shield-lock"></i>Admin Workspace</span>
                <h1>School Records Dashboard</h1>
                <p>Manage students, teachers, degrees, and role-based access from one organized command center.</p>
            </div>

            <aside class="admin-today-card">
                <i class="bi bi-calendar2-check"></i>
                <strong>Administrator</strong>
                <span>{{ now()->format('M d, Y') }}</span>
            </aside>
        </header>

        <section class="admin-stat-grid">
            <div class="admin-stat">
                <i class="bi bi-mortarboard-fill"></i>
                <div><span>Students</span><strong>{{ $studentCount }}</strong></div>
            </div>
            <div class="admin-stat">
                <i class="bi bi-person-video3"></i>
                <div><span>Teachers</span><strong>{{ $teacherCount }}</strong></div>
            </div>
            <div class="admin-stat">
                <i class="bi bi-people-fill"></i>
                <div><span>Total Users</span><strong>{{ $studentCount + $teacherCount }}</strong></div>
            </div>
        </section>

        <div class="admin-work-grid">
            <section class="admin-panel-new">
                <div class="panel-title-new">
                    <span>Quick Actions</span>
                    <h2>Manage Records</h2>
                </div>

                <div class="admin-actions-new">
                    <a class="admin-action-new" href="/students/create">
                        <i class="bi bi-person-plus-fill"></i>
                        <div><strong>Add Student</strong><span>Create student record and login access.</span></div>
                    </a>
                    <a class="admin-action-new" href="{{ route('teachers.create') }}">
                        <i class="bi bi-person-fill-add"></i>
                        <div><strong>Add Teacher</strong><span>Create a teacher account.</span></div>
                    </a>
                    <a class="admin-action-new" href="/students">
                        <i class="bi bi-table"></i>
                        <div><strong>Student List</strong><span>Review, update, and manage student data.</span></div>
                    </a>
                    <a class="admin-action-new" href="{{ route('teachers.index') }}">
                        <i class="bi bi-journal-bookmark-fill"></i>
                        <div><strong>Teacher List</strong><span>View all teacher accounts.</span></div>
                    </a>
                </div>
            </section>

            <aside class="admin-panel-new">
                <div class="panel-title-new">
                    <span>Status</span>
                    <h2>System Checks</h2>
                </div>

                <div class="admin-check-list">
                    <div><i class="bi bi-check-circle-fill"></i>Admin routes are role protected</div>
                    <div><i class="bi bi-check-circle-fill"></i>Student AJAX list route is active</div>
                    <div><i class="bi bi-check-circle-fill"></i>Teacher and student dashboards are available</div>
                </div>
            </aside>
        </div>
    </section>
@endsection
