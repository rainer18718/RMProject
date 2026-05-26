@extends('layouts.app')

@section('title', 'Teacher Dashboard')

@section('content')
    <style>
        .teacher-console {
            display: grid;
            gap: 16px;
        }

        .teacher-hero-new {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 250px;
            gap: 18px;
            align-items: stretch;
            padding: clamp(22px, 4vw, 34px);
            border-radius: 8px;
            background:
                linear-gradient(135deg, rgba(19, 35, 58, 0.95), rgba(37, 99, 235, 0.82) 58%, rgba(216, 90, 58, 0.78)),
                url("https://images.unsplash.com/photo-1577896851231-70ef18881754?auto=format&fit=crop&w=1400&q=80") center/cover;
            border: 1px solid rgba(19, 35, 58, 0.14);
            box-shadow: 0 18px 42px rgba(19, 35, 58, 0.20);
            color: #ffffff;
        }

        .teacher-hero-new h1 {
            margin: 8px 0 10px;
            color: #ffffff !important;
            font-size: clamp(32px, 4vw, 46px);
        }

        .teacher-hero-new p {
            max-width: 650px;
            margin: 0;
            color: #eef4ff !important;
        }

        .teacher-label,
        .teacher-panel-title span {
            color: #ffd9c9 !important;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .teacher-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .teacher-badge-new {
            display: grid;
            align-content: center;
            gap: 8px;
            padding: 18px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.22);
        }

        .teacher-badge-new i {
            color: #ffd9c9;
            font-size: 30px;
        }

        .teacher-badge-new strong {
            color: #ffffff;
            font-size: 20px;
        }

        .teacher-badge-new span {
            color: #eef4ff;
            font-weight: 850;
        }

        .teacher-main-new {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 310px;
            gap: 16px;
            align-items: start;
        }

        .teacher-panel-new,
        .teacher-side-new {
            border: 1px solid #d9e1ea;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.96);
            box-shadow: 0 16px 36px rgba(23, 32, 51, 0.10);
            padding: 22px;
        }

        .teacher-panel-title {
            margin-bottom: 16px;
        }

        .teacher-panel-title span {
            color: #d85a3a !important;
        }

        .teacher-panel-title h2 {
            margin: 5px 0 0;
            color: #172033 !important;
        }

        .teacher-panel-new p,
        .teacher-side-new p {
            color: #667085 !important;
        }

        .teacher-status-grid-new {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 18px;
        }

        .teacher-status-new {
            display: grid;
            gap: 8px;
            min-height: 132px;
            padding: 16px;
            border-radius: 8px;
            background: #f8faf7;
            border: 1px solid #d9e1ea;
        }

        .teacher-status-new i,
        .teacher-side-new > i {
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

        .teacher-status-new span {
            color: #d85a3a;
            font-size: 12px;
            font-weight: 900;
            text-transform: uppercase;
        }

        .teacher-status-new strong {
            color: #172033;
            font-size: 17px;
        }

        .teacher-side-new {
            display: grid;
            gap: 12px;
            background: #f8faf7;
        }

        .teacher-side-new h2 {
            margin: 0;
            color: #172033 !important;
        }

        .teacher-side-new p {
            margin: 0;
        }

        @media (max-width: 900px) {
            .teacher-hero-new,
            .teacher-main-new,
            .teacher-status-grid-new {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <section class="teacher-console">
        <header class="teacher-hero-new">
            <div>
                <span class="teacher-label"><i class="bi bi-person-video3"></i>Teacher Workspace</span>
                <h1>Teaching Dashboard</h1>
                <p>Your teacher session is active and protected by role-based access.</p>
            </div>

            <aside class="teacher-badge-new">
                <i class="bi bi-person-badge-fill"></i>
                <strong>Teacher</strong>
                <span>Session Active</span>
            </aside>
        </header>

        <div class="teacher-main-new">
            <section class="teacher-panel-new">
                <div class="teacher-panel-title">
                    <span>Account Overview</span>
                    <h2>Teacher Status</h2>
                </div>

                <p>You are viewing the teacher dashboard. Admin and student pages remain protected by session and role middleware.</p>

                <div class="teacher-status-grid-new">
                    <div class="teacher-status-new">
                        <i class="bi bi-key-fill"></i>
                        <span>Access Level</span>
                        <strong>Teacher</strong>
                    </div>
                    <div class="teacher-status-new">
                        <i class="bi bi-wifi"></i>
                        <span>Session</span>
                        <strong>Active</strong>
                    </div>
                    <div class="teacher-status-new">
                        <i class="bi bi-lock-fill"></i>
                        <span>Protection</span>
                        <strong>Enabled</strong>
                    </div>
                </div>
            </section>

            <aside class="teacher-side-new">
                <i class="bi bi-check2-circle"></i>
                <h2>Ready</h2>
                <p>Your teacher account is verified and available for protected teacher pages.</p>
            </aside>
        </div>
    </section>
@endsection
