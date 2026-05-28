<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'CSCB Module 6 Lab Activity')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            margin: 0;
            background:
                linear-gradient(180deg, #f8fbff 0%, #eef6ff 48%, #f8fafc 100%);
            color: #1f2937;
        }

        nav {
            background: #12343b;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 10px 24px rgba(18, 52, 59, 0.20);
        }

        nav a,
        nav button {
            color: #dbeafe;
            background: none;
            border: 0;
            text-decoration: none;
            font-weight: 700;
            cursor: pointer;
            font-size: 14px;
            padding: 8px 10px;
            border-radius: 8px;
        }

        nav a:hover,
        nav button:hover {
            background: rgba(217, 249, 157, 0.14);
            color: #ffffff;
        }

        .nav-brand {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #ffffff;
            font-weight: 900;
            margin-right: 8px;
        }

        .nav-spacer {
            flex: 1;
        }

        .container {
            width: 90%;
            max-width: 1140px;
            margin: 30px auto;
            background: transparent;
            padding: 28px;
            border-radius: 0;
            box-shadow: none;
        }

        h1, h2 {
            margin-top: 0;
        }

        h1 {
            color: #0f172a;
            font-size: 32px;
            letter-spacing: 0;
        }

        h2 {
            color: #111827;
            font-size: 20px;
        }

        p {
            color: #4b5563;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            padding: 10px 14px;
            text-decoration: none;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-primary {
            background-color: #0f766e;
            color: white;
        }

        .btn-success {
            background-color: #16a34a;
            color: white;
        }

        .btn-warning {
            background-color: #f59e0b;
            color: white;
        }

        .btn-danger {
            background-color: #dc2626;
            color: white;
        }

        .btn-secondary {
            background-color: #334155;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            table-layout: auto;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px 12px;
            text-align: left;
        }

        th {
            background-color: #f3f4f6;
        }

        form {
            margin-top: 15px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: nowrap;
            align-items: center;
        }

        .actions .btn,
        .actions form {
            margin: 0;
        }

        .actions .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .actions form {
            display: inline-flex;
        }

        td:last-child,
        th:last-child {
            width: 1%;
            white-space: nowrap;
        }

        .btn i {
            margin-right: 6px;
        }

        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .alert-success {
            background-color: #dcfce7;
            color: #166534;
        }

        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .card {
            padding: 20px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            margin-top: 15px;
            background: #ffffff;
            box-shadow: 0 10px 24px rgba(31, 41, 55, 0.06);
        }

        .dashboard-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 24px;
            align-items: center;
            padding: 28px;
            border-radius: 12px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            color: #0f172a;
            margin-bottom: 22px;
            box-shadow: 0 10px 24px rgba(31, 41, 55, 0.06);
        }

        .dashboard-hero h1,
        .dashboard-hero p {
            color: #0f172a;
        }

        .dashboard-hero h1 {
            margin-bottom: 8px;
        }

        .dashboard-hero p {
            margin: 0;
            color: #64748b;
        }

        .role-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            min-height: 38px;
            padding: 0 14px;
            border-radius: 8px;
            background: #ecfdf5;
            border: 1px solid #bbf7d0;
            color: #166534;
            font-weight: 800;
            white-space: nowrap;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .admin-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 230px;
            gap: 24px;
            align-items: stretch;
            padding: 28px;
            border-radius: 12px;
            color: #ffffff;
            background:
                linear-gradient(135deg, rgba(15, 23, 42, 0.94), rgba(30, 64, 175, 0.88)),
                radial-gradient(circle at top right, rgba(20, 184, 166, 0.45), transparent 32%);
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.18);
            margin-bottom: 22px;
            overflow: hidden;
        }

        .admin-hero-copy {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 160px;
        }

        .admin-kicker {
            color: #a7f3d0;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .admin-hero h1 {
            color: #ffffff;
            font-size: 38px;
            margin-bottom: 10px;
        }

        .admin-hero p {
            max-width: 620px;
            color: #dbeafe;
            margin: 0;
        }

        .admin-hero-panel {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 160px;
            padding: 18px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.12);
        }

        .admin-hero-panel strong {
            color: #ffffff;
            font-size: 24px;
        }

        .admin-hero-panel small {
            color: #bfdbfe;
            font-weight: 700;
        }

        .admin-dashboard-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 18px;
            align-items: start;
        }

        .admin-main,
        .admin-side {
            display: grid;
            gap: 18px;
        }

        .admin-stats {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .stat-card {
            padding: 22px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            box-shadow: 0 10px 24px rgba(31, 41, 55, 0.06);
        }

        .admin-stats .stat-card {
            display: flex;
            align-items: center;
            gap: 16px;
            min-height: 122px;
        }

        .stat-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 10px;
            font-size: 22px;
        }

        .stat-card-blue .stat-icon {
            color: #1d4ed8;
            background: #dbeafe;
        }

        .stat-card-green .stat-icon {
            color: #047857;
            background: #d1fae5;
        }

        .stat-label {
            margin: 0 0 8px;
            color: #64748b;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .stat-value {
            margin: 0;
            color: #2563eb;
            font-size: 34px;
            font-weight: 800;
        }

        .admin-panel {
            padding: 22px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            background: #ffffff;
            box-shadow: 0 10px 24px rgba(31, 41, 55, 0.06);
        }

        .section-heading {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 16px;
        }

        .section-heading span {
            display: block;
            color: #2563eb;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            margin-bottom: 4px;
        }

        .section-heading h2 {
            margin: 0;
        }

        .section-heading.compact {
            margin-bottom: 12px;
        }

        .tool-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .tool-card {
            display: grid;
            gap: 8px;
            min-height: 146px;
            padding: 18px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #0f172a;
            text-decoration: none;
            transition: transform 160ms ease, border-color 160ms ease, box-shadow 160ms ease;
        }

        .tool-card:hover {
            transform: translateY(-2px);
            border-color: #93c5fd;
            box-shadow: 0 14px 28px rgba(37, 99, 235, 0.12);
        }

        .tool-card i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 8px;
            color: #1d4ed8;
            background: #dbeafe;
            font-size: 19px;
        }

        .tool-card strong {
            font-size: 16px;
        }

        .tool-card span {
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .summary-list {
            display: grid;
            gap: 10px;
        }

        .summary-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 13px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .summary-item:last-child {
            border-bottom: 0;
        }

        .summary-item span {
            color: #64748b;
            font-weight: 700;
        }

        .summary-item strong {
            color: #0f172a;
            font-size: 20px;
        }

        .admin-note {
            display: flex;
            gap: 14px;
            background: #f0fdfa;
            border-color: #99f6e4;
        }

        .admin-note i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            width: 40px;
            height: 40px;
            border-radius: 8px;
            color: #0f766e;
            background: #ccfbf1;
            font-size: 20px;
        }

        .admin-note h2 {
            margin-bottom: 4px;
            font-size: 17px;
        }

        .admin-note p {
            margin: 0;
            font-size: 14px;
        }

        .action-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .profile-list {
            display: grid;
            gap: 12px;
            margin-top: 12px;
        }

        .profile-item {
            display: flex;
            justify-content: space-between;
            gap: 16px;
            padding: 13px 0;
            border-bottom: 1px solid #e5e7eb;
        }

        .profile-item:last-child {
            border-bottom: 0;
        }

        .profile-item span {
            color: #64748b;
            font-weight: 700;
        }

        .profile-item strong {
            color: #0f172a;
            text-align: right;
        }

        .role-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 230px;
            gap: 22px;
            align-items: stretch;
            padding: 30px;
            border-radius: 14px;
            margin-bottom: 18px;
            box-shadow: 0 18px 42px rgba(15, 23, 42, 0.14);
        }

        .admin-theme {
            background: linear-gradient(135deg, #0f172a, #1d4ed8 58%, #0f766e);
        }

        .teacher-theme {
            background: linear-gradient(135deg, #164e63, #2563eb 58%, #7c3aed);
        }

        .student-theme {
            background: linear-gradient(135deg, #14532d, #0f766e 56%, #ca8a04);
        }

        .role-hero h1 {
            color: #ffffff;
            font-size: 38px;
            margin-bottom: 10px;
        }

        .role-hero p {
            max-width: 660px;
            margin: 0;
            color: rgba(255, 255, 255, 0.84);
        }

        .eyebrow {
            display: inline-flex;
            margin-bottom: 10px;
            color: #fef3c7;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .hero-status {
            display: grid;
            align-content: space-between;
            min-height: 150px;
            padding: 18px;
            border: 1px solid rgba(255, 255, 255, 0.24);
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.14);
            color: #ffffff;
        }

        .hero-status i {
            font-size: 28px;
        }

        .hero-status span {
            color: rgba(255, 255, 255, 0.82);
            font-weight: 700;
        }

        .hero-status strong {
            font-size: 22px;
        }

        .metric-strip {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 18px;
        }

        .metric-card,
        .workspace-panel {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 10px 26px rgba(15, 23, 42, 0.07);
        }

        .metric-card {
            display: grid;
            gap: 8px;
            padding: 18px;
        }

        .metric-card i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            color: #1d4ed8;
            background: #dbeafe;
            font-size: 20px;
        }

        .metric-card span {
            color: #64748b;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .metric-card strong {
            color: #0f172a;
            font-size: 28px;
            line-height: 1;
        }

        .workspace-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 320px;
            gap: 18px;
            align-items: start;
        }

        .workspace-panel {
            padding: 22px;
        }

        .wide-panel {
            min-height: 250px;
        }

        .panel-title {
            margin-bottom: 16px;
        }

        .panel-title span {
            display: block;
            margin-bottom: 4px;
            color: #2563eb;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .panel-title h2,
        .accent-panel h2 {
            margin: 0;
        }

        .panel-copy {
            max-width: 720px;
            margin: 0;
        }

        .action-tile-grid,
        .profile-mosaic {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .action-tile,
        .profile-card {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #f8fafc;
            padding: 18px;
        }

        .action-tile {
            display: grid;
            gap: 8px;
            min-height: 140px;
            color: #0f172a;
            text-decoration: none;
            transition: transform 150ms ease, border-color 150ms ease, box-shadow 150ms ease;
        }

        .action-tile:hover {
            transform: translateY(-2px);
            border-color: #93c5fd;
            box-shadow: 0 14px 26px rgba(37, 99, 235, 0.14);
        }

        .action-tile i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 9px;
            color: #0f766e;
            background: #ccfbf1;
            font-size: 20px;
        }

        .action-tile strong,
        .profile-card strong {
            color: #0f172a;
            font-size: 16px;
        }

        .action-tile span,
        .profile-card span {
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .profile-card {
            display: grid;
            gap: 8px;
            min-height: 108px;
        }

        .check-list {
            display: grid;
            gap: 12px;
        }

        .check-list div {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            color: #334155;
            font-weight: 700;
            line-height: 1.5;
        }

        .check-list i {
            color: #16a34a;
            font-size: 18px;
            margin-top: 2px;
        }

        .accent-panel {
            display: grid;
            gap: 10px;
            background: #fffbeb;
            border-color: #fde68a;
        }

        .accent-panel > i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 10px;
            color: #92400e;
            background: #fef3c7;
            font-size: 22px;
        }

        .accent-panel p {
            margin: 0;
        }

        .empty-state {
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 18px;
            border-radius: 10px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
        }

        .empty-state i {
            color: #2563eb;
            font-size: 22px;
        }

        .empty-state p {
            margin: 0;
        }

        .form-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 18px;
            align-items: center;
            padding: 28px;
            border-radius: 14px;
            margin-bottom: 18px;
            box-shadow: 0 18px 42px rgba(15, 23, 42, 0.14);
        }

        .student-form-theme {
            background: linear-gradient(135deg, #0f766e, #2563eb);
        }

        .teacher-form-theme {
            background:
                linear-gradient(135deg, #12343b 0%, #0f766e 72%),
                radial-gradient(circle at top right, rgba(217, 249, 157, 0.28), transparent 34%);
        }

        .form-hero h1 {
            color: #ffffff;
            font-size: 34px;
            margin-bottom: 8px;
        }

        .form-hero p {
            margin: 0;
            color: rgba(255, 255, 255, 0.84);
        }

        .hero-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 14px;
            border-radius: 9px;
            background: rgba(255, 255, 255, 0.14);
            border: 1px solid rgba(255, 255, 255, 0.22);
            color: #ffffff;
            text-decoration: none;
            font-weight: 800;
            white-space: nowrap;
        }

        .hero-link:hover {
            background: rgba(255, 255, 255, 0.22);
        }

        .form-workspace {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 18px;
            align-items: start;
        }

        .form-card,
        .form-side-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 10px 26px rgba(15, 23, 42, 0.07);
        }

        .form-card {
            padding: 24px;
        }

        .modern-form {
            margin-top: 0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .form-grid.single-row {
            align-items: start;
        }

        .field-group {
            display: grid;
            gap: 8px;
        }

        .field-group.full-span {
            grid-column: 1 / -1;
        }

        .field-group label {
            margin: 0;
            color: #334155;
            font-size: 13px;
            font-weight: 800;
        }

        .field-control {
            position: relative;
        }

        .field-control i {
            position: absolute;
            top: 50%;
            left: 14px;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 16px;
            pointer-events: none;
        }

        .field-control input,
        .field-control select {
            width: 100%;
            min-height: 46px;
            margin: 0;
            padding: 0 14px 0 42px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background: #f8fafc;
            color: #0f172a;
            font-size: 14px;
            outline: none;
            transition: border-color 150ms ease, box-shadow 150ms ease, background-color 150ms ease;
        }

        .field-control select {
            appearance: none;
            padding-right: 34px;
        }

        .field-control input:focus,
        .field-control select:focus {
            background: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .form-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px solid #e2e8f0;
        }

        .form-actions .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 42px;
        }

        .form-side-card {
            display: grid;
            gap: 10px;
            padding: 22px;
            background: #f0fdfa;
            border-color: #99f6e4;
        }

        .form-side-card.teacher-card {
            background: #ecfdf5;
            border-color: #bbf7d0;
        }

        .form-side-card > i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 10px;
            color: #0f766e;
            background: #ccfbf1;
            font-size: 22px;
        }

        .form-side-card.teacher-card > i {
            color: #0f766e;
            background: #ccfbf1;
        }

        .form-side-card h2 {
            margin: 0;
        }

        .form-side-card p {
            margin: 0;
            font-size: 14px;
        }

        .form-errors {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-radius: 10px;
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .form-errors strong {
            display: block;
            margin-bottom: 6px;
        }

        .form-errors ul {
            margin: 0;
            padding-left: 18px;
        }

        .form-hero.student-form-theme,
        .form-hero.teacher-form-theme {
            padding: 30px;
            border-radius: 20px;
            background:
                linear-gradient(135deg, #12343b 0%, #0f766e 72%),
                radial-gradient(circle at top right, rgba(217, 249, 157, 0.28), transparent 34%);
            box-shadow: 0 22px 48px rgba(18, 52, 59, 0.22);
        }

        .form-hero.student-form-theme .eyebrow,
        .form-hero.teacher-form-theme .eyebrow {
            color: #d9f99d;
        }

        .form-hero.student-form-theme p,
        .form-hero.teacher-form-theme p {
            color: #d1fae5;
        }

        .hero-link {
            border-color: rgba(217, 249, 157, 0.28);
            background: rgba(255, 255, 255, 0.12);
            box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.04);
        }

        .hero-link:hover {
            background: rgba(217, 249, 157, 0.16);
        }

        .form-workspace {
            grid-template-columns: minmax(0, 1fr) 300px;
        }

        .form-card,
        .form-side-card {
            border-color: #bbf7d0;
            border-radius: 18px;
            box-shadow: 0 14px 34px rgba(18, 52, 59, 0.10);
        }

        .form-card {
            padding: 26px;
        }

        .panel-title span {
            color: #0f766e;
        }

        .field-group label {
            color: #12343b;
            letter-spacing: 0.02em;
        }

        .field-control i {
            color: #0f766e;
        }

        .field-control input,
        .field-control select {
            min-height: 48px;
            border-color: #cbd5e1;
            border-radius: 12px;
            background: #f8fbfa;
        }

        .field-control input:focus,
        .field-control select:focus {
            border-color: #0f766e;
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.13);
        }

        .form-actions {
            border-top-color: #d1fae5;
        }

        .form-actions .btn {
            border-radius: 11px;
            font-weight: 800;
            padding: 10px 16px;
        }

        .form-actions .btn-primary {
            background: #0f766e;
            box-shadow: 0 12px 22px rgba(15, 118, 110, 0.20);
        }

        .form-actions .btn-primary:hover {
            background: #115e59;
        }

        .form-actions .btn-secondary {
            background: #334155;
        }

        .form-side-card {
            background: #ecfdf5;
            border-color: #bbf7d0;
            padding: 24px;
        }

        .form-side-card > i {
            border-radius: 12px;
            color: #0f766e;
            background: #ccfbf1;
        }

        .form-side-card h2 {
            color: #12343b;
        }

        .admin-cockpit {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 260px;
            gap: 18px;
            align-items: stretch;
            margin-bottom: 16px;
        }

        .cockpit-copy,
        .cockpit-card,
        .admin-kpi-card,
        .command-panel,
        .mini-panel {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #ffffff;
            box-shadow: 0 10px 26px rgba(15, 23, 42, 0.07);
        }

        .cockpit-copy {
            min-height: 210px;
            padding: 30px;
            background:
                linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(240, 253, 250, 0.92)),
                linear-gradient(90deg, #ffffff, #eff6ff);
            border-left: 6px solid #0f766e;
        }

        .cockpit-label {
            display: inline-flex;
            margin-bottom: 14px;
            color: #0f766e;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .cockpit-copy h1 {
            margin-bottom: 10px;
            color: #0f172a;
            font-size: 40px;
        }

        .cockpit-copy p {
            max-width: 650px;
            margin: 0;
            color: #475569;
        }

        .cockpit-card {
            display: grid;
            align-content: center;
            gap: 10px;
            padding: 24px;
            background: #0f172a;
            color: #ffffff;
        }

        .cockpit-card i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 10px;
            background: #134e4a;
            color: #99f6e4;
            font-size: 24px;
        }

        .cockpit-card span {
            color: #cbd5e1;
            font-weight: 800;
        }

        .cockpit-card strong {
            font-size: 22px;
        }

        .admin-kpi-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 16px;
        }

        .admin-kpi-card {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px;
        }

        .kpi-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex: 0 0 auto;
            width: 46px;
            height: 46px;
            border-radius: 10px;
            font-size: 22px;
        }

        .kpi-icon.blue {
            color: #1d4ed8;
            background: #dbeafe;
        }

        .kpi-icon.green {
            color: #047857;
            background: #d1fae5;
        }

        .kpi-icon.amber {
            color: #92400e;
            background: #fef3c7;
        }

        .admin-kpi-card p {
            margin: 0 0 5px;
            color: #64748b;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .admin-kpi-card strong {
            color: #0f172a;
            font-size: 30px;
            line-height: 1;
        }

        .admin-command-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 310px;
            gap: 18px;
            align-items: start;
        }

        .command-panel {
            padding: 22px;
        }

        .command-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 16px;
        }

        .command-heading span,
        .mini-panel > span {
            display: block;
            margin-bottom: 4px;
            color: #2563eb;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .command-heading h2,
        .mini-panel h2 {
            margin: 0;
        }

        .command-heading > i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: #f1f5f9;
            color: #0f172a;
            font-size: 20px;
        }

        .command-list {
            display: grid;
            gap: 12px;
        }

        .command-item {
            display: grid;
            grid-template-columns: 46px minmax(0, 1fr) 30px;
            gap: 14px;
            align-items: center;
            padding: 16px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #f8fafc;
            color: #0f172a;
            text-decoration: none;
            transition: transform 150ms ease, box-shadow 150ms ease, border-color 150ms ease;
        }

        .command-item:hover {
            transform: translateX(3px);
            border-color: #99f6e4;
            box-shadow: 0 12px 22px rgba(15, 118, 110, 0.11);
        }

        .command-item > span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 10px;
            background: #ccfbf1;
            color: #0f766e;
            font-size: 20px;
        }

        .command-item strong {
            color: #0f172a;
            font-size: 16px;
        }

        .command-item p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.4;
        }

        .command-item > i {
            color: #2563eb;
            font-size: 24px;
        }

        .admin-side-stack {
            display: grid;
            gap: 14px;
        }

        .mini-panel {
            padding: 20px;
        }

        .mini-panel p {
            margin: 10px 0 0;
            font-size: 14px;
        }

        .mini-panel.dark {
            display: grid;
            gap: 12px;
            background: #0f172a;
            border-color: #0f172a;
        }

        .mini-panel.dark,
        .mini-panel.dark h2,
        .mini-panel.dark strong {
            color: #ffffff;
        }

        .mini-panel.dark i {
            color: #99f6e4;
            font-size: 24px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            padding-top: 10px;
            border-top: 1px solid rgba(255, 255, 255, 0.12);
        }

        .summary-row span {
            color: #cbd5e1;
            font-weight: 700;
        }

        .portal-banner {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 220px;
            gap: 18px;
            align-items: stretch;
            padding: 28px;
            border-radius: 18px;
            margin-bottom: 16px;
            box-shadow: 0 20px 44px rgba(37, 99, 235, 0.18);
        }

        .admin-banner {
            background: linear-gradient(135deg, #0f172a, #0f766e);
        }

        .teacher-banner {
            background: linear-gradient(135deg, #164e63, #2563eb);
        }

        .student-banner {
            background:
                linear-gradient(135deg, rgba(30, 64, 175, 0.96), rgba(79, 70, 229, 0.92)),
                radial-gradient(circle at top right, rgba(14, 165, 233, 0.42), transparent 38%);
        }

        .portal-banner span {
            display: inline-flex;
            margin-bottom: 10px;
            color: #bfdbfe;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .portal-banner h1 {
            margin-bottom: 10px;
            color: #ffffff;
            font-size: 38px;
        }

        .portal-banner p {
            max-width: 640px;
            margin: 0;
            color: rgba(239, 246, 255, 0.9);
        }

        .banner-badge {
            display: grid;
            align-content: center;
            justify-items: start;
            gap: 8px;
            min-height: 150px;
            padding: 18px;
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.30);
            color: #ffffff;
            backdrop-filter: blur(8px);
        }

        .banner-badge i {
            font-size: 28px;
        }

        .banner-badge strong {
            font-size: 22px;
        }

        .banner-badge small {
            color: rgba(255, 255, 255, 0.78);
            font-weight: 800;
        }

        .portal-stat-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 16px;
        }

        .portal-stat,
        .portal-panel {
            border: 1px solid #dbeafe;
            border-radius: 16px;
            background: #ffffff;
            box-shadow: 0 14px 30px rgba(30, 64, 175, 0.08);
        }

        .portal-stat {
            display: grid;
            gap: 8px;
            padding: 18px;
        }

        .portal-stat i,
        .side-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 20px;
        }

        .portal-stat span,
        .portal-heading span {
            color: #64748b;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .portal-stat strong {
            color: #0f172a;
            font-size: 28px;
            line-height: 1;
        }

        .portal-layout {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 18px;
            align-items: start;
        }

        .portal-panel {
            padding: 24px;
        }

        .portal-heading {
            margin-bottom: 16px;
        }

        .portal-heading span {
            display: block;
            margin-bottom: 4px;
            color: #2563eb;
        }

        .portal-heading h2,
        .side-panel h2 {
            margin: 0;
        }

        .portal-action-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .portal-action {
            display: grid;
            gap: 8px;
            min-height: 138px;
            padding: 18px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #0f172a;
            text-decoration: none;
            transition: transform 150ms ease, box-shadow 150ms ease, border-color 150ms ease;
        }

        .portal-action:hover {
            transform: translateY(-2px);
            border-color: #99f6e4;
            box-shadow: 0 14px 26px rgba(15, 118, 110, 0.12);
        }

        .portal-action i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 19px;
        }

        .portal-action strong,
        .portal-profile-grid strong {
            color: #0f172a;
            font-size: 16px;
        }

        .portal-action span,
        .portal-profile-grid span {
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .side-panel {
            display: grid;
            gap: 10px;
            background: #eff6ff;
            border-color: #bfdbfe;
        }

        .portal-copy {
            margin: 0;
        }

        .portal-timeline {
            display: grid;
            gap: 12px;
        }

        .portal-timeline div {
            display: flex;
            gap: 10px;
            color: #334155;
            font-weight: 800;
            line-height: 1.5;
        }

        .portal-timeline i {
            color: #16a34a;
            margin-top: 2px;
        }

        .portal-profile-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .portal-profile-grid div,
        .portal-empty {
            border: 1px solid #dbeafe;
            border-radius: 14px;
            background: linear-gradient(180deg, #ffffff, #f8fbff);
            padding: 18px;
        }

        .portal-profile-grid div {
            display: grid;
            gap: 8px;
            min-height: 104px;
        }

        .portal-empty {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .portal-empty i {
            color: #2563eb;
            font-size: 22px;
        }

        .portal-empty p {
            margin: 0;
        }

        .teacher-shell {
            display: grid;
            gap: 18px;
        }

        .teacher-hero-card {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 230px;
            gap: 18px;
            align-items: stretch;
            padding: 30px;
            border-radius: 20px;
            background:
                linear-gradient(135deg, #12343b 0%, #0f766e 72%),
                radial-gradient(circle at top right, rgba(217, 249, 157, 0.28), transparent 34%);
            box-shadow: 0 22px 48px rgba(18, 52, 59, 0.22);
        }

        .teacher-hero-copy {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 165px;
        }

        .teacher-hero-copy span,
        .teacher-section-title span {
            color: #d9f99d;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .teacher-hero-copy h1 {
            margin: 10px 0;
            color: #ffffff;
            font-size: 40px;
        }

        .teacher-hero-copy p {
            max-width: 620px;
            margin: 0;
            color: #d1fae5;
        }

        .teacher-profile-badge {
            display: grid;
            align-content: center;
            gap: 9px;
            min-height: 165px;
            padding: 20px;
            border-radius: 16px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.22);
            color: #ffffff;
        }

        .teacher-profile-badge i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(217, 249, 157, 0.18);
            color: #d9f99d;
            font-size: 22px;
        }

        .teacher-profile-badge strong {
            font-size: 22px;
        }

        .teacher-profile-badge small {
            color: #d1fae5;
            font-weight: 800;
        }

        .teacher-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 18px;
            align-items: start;
        }

        .teacher-panel {
            border: 1px solid #bbf7d0;
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 14px 34px rgba(18, 52, 59, 0.10);
        }

        .main-panel {
            padding: 24px;
        }

        .teacher-section-title {
            margin-bottom: 12px;
        }

        .teacher-section-title span {
            color: #0f766e;
        }

        .teacher-section-title h2,
        .side-ready-panel h2 {
            margin: 4px 0 0;
        }

        .main-panel p,
        .side-ready-panel p {
            margin: 0;
        }

        .teacher-status-list {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 12px;
            margin-top: 20px;
        }

        .teacher-status-list div {
            display: grid;
            gap: 8px;
            min-height: 126px;
            padding: 16px;
            border-radius: 14px;
            background: #f0fdfa;
            border: 1px solid #ccfbf1;
        }

        .teacher-status-list i,
        .side-ready-panel > i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: #ccfbf1;
            color: #0f766e;
            font-size: 20px;
        }

        .teacher-status-list span {
            color: #64748b;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .teacher-status-list strong {
            color: #0f172a;
            font-size: 22px;
        }

        .side-ready-panel {
            display: grid;
            gap: 10px;
            padding: 24px;
            background: #ecfdf5;
        }

        .student-profile-shell {
            display: grid;
            gap: 18px;
        }

        .student-cover {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 250px;
            gap: 18px;
            align-items: stretch;
            padding: 30px;
            border-radius: 20px;
            background:
                linear-gradient(135deg, #12343b 0%, #0f766e 72%),
                radial-gradient(circle at top right, rgba(217, 249, 157, 0.28), transparent 34%);
            box-shadow: 0 22px 48px rgba(18, 52, 59, 0.22);
        }

        .student-cover > div:first-child {
            display: flex;
            min-height: 170px;
            flex-direction: column;
            justify-content: center;
        }

        .student-cover span,
        .student-panel-title span {
            color: #d9f99d;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .student-cover h1 {
            margin: 10px 0;
            color: #ffffff;
            font-size: 40px;
        }

        .student-cover p {
            margin: 0;
            color: #d1fae5;
        }

        .student-access-card {
            display: grid;
            align-content: center;
            gap: 9px;
            padding: 20px;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.22);
            background: rgba(255, 255, 255, 0.12);
            color: #ffffff;
        }

        .student-access-card i,
        .student-status-panel > i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(217, 249, 157, 0.18);
            color: #d9f99d;
            font-size: 22px;
        }

        .student-access-card strong {
            font-size: 21px;
        }

        .student-access-card small {
            color: #d1fae5;
            font-weight: 800;
        }

        .student-content-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 300px;
            gap: 18px;
            align-items: start;
        }

        .student-info-panel,
        .student-status-panel {
            border: 1px solid #bbf7d0;
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 14px 34px rgba(18, 52, 59, 0.10);
        }

        .student-info-panel {
            padding: 24px;
        }

        .student-panel-title {
            margin-bottom: 16px;
        }

        .student-panel-title span {
            color: #0f766e;
        }

        .student-panel-title h2,
        .student-status-panel h2 {
            margin: 4px 0 0;
        }

        .student-detail-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .student-detail-grid div {
            display: grid;
            gap: 8px;
            min-height: 130px;
            padding: 16px;
            border-radius: 14px;
            border: 1px solid #ccfbf1;
            background: #f8fbfa;
        }

        .student-detail-grid i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 11px;
            background: #ccfbf1;
            color: #0f766e;
            font-size: 18px;
        }

        .student-detail-grid span {
            color: #64748b;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .student-detail-grid strong {
            color: #0f172a;
            overflow-wrap: anywhere;
        }

        .student-status-panel {
            display: grid;
            gap: 10px;
            padding: 24px;
            background: #ecfdf5;
        }

        .student-status-panel > i {
            background: #ccfbf1;
            color: #0f766e;
        }

        .student-status-panel p {
            margin: 0;
        }

        .student-empty-state {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 18px;
            border-radius: 14px;
            border: 1px solid #ccfbf1;
            background: #f8fbfa;
        }

        .student-empty-state i {
            color: #0f766e;
            font-size: 22px;
        }

        .student-empty-state p {
            margin: 0;
        }

        .mb-2 {
            margin-bottom: 10px;
        }

        .pagination {
            margin-top: 20px;
        }

        .pagination svg {
            width: 18px;
        }

        .ajax-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .ajax-card {
            padding: 22px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            background: #ffffff;
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.06);
            margin-bottom: 18px;
        }

        .ajax-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
        }

        .ajax-form-grid label {
            display: block;
            color: #334155;
            font-size: 13px;
            font-weight: 800;
        }

        .ajax-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
            margin-top: 6px;
        }

        .ajax-message {
            display: none;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 14px;
            font-weight: 700;
        }

        .ajax-message.success {
            display: block;
            color: #166534;
            background: #dcfce7;
        }

        .ajax-message.error {
            display: block;
            color: #991b1b;
            background: #fee2e2;
        }

        .ajax-table-wrap {
            overflow-x: auto;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: #ffffff;
        }

        .ajax-table-wrap table {
            margin-top: 0;
        }

        .loading-row {
            color: #64748b;
            text-align: center;
            font-weight: 700;
        }

        @media (max-width: 720px) {
            nav {
                padding: 12px 18px;
            }

            .container {
                width: calc(100% - 24px);
                margin: 18px auto;
                padding: 18px;
            }

            .dashboard-hero,
            .dashboard-grid,
            .ajax-form-grid {
                grid-template-columns: 1fr;
            }

            .admin-hero,
            .admin-dashboard-grid,
            .admin-stats,
            .tool-grid {
                grid-template-columns: 1fr;
            }

            .admin-hero {
                padding: 22px;
            }

            .admin-hero h1 {
                font-size: 32px;
            }

            .role-hero,
            .metric-strip,
            .workspace-grid,
            .action-tile-grid,
            .profile-mosaic,
            .form-hero,
            .form-workspace,
            .form-grid,
            .admin-cockpit,
            .admin-kpi-row,
            .admin-command-grid,
            .portal-banner,
            .portal-stat-grid,
            .portal-layout,
            .portal-action-grid,
            .portal-profile-grid,
            .teacher-hero-card,
            .teacher-grid,
            .teacher-status-list,
            .student-cover,
            .student-content-grid,
            .student-detail-grid {
                grid-template-columns: 1fr;
            }

            .role-hero {
                padding: 22px;
            }

            .role-hero h1 {
                font-size: 30px;
            }

            .form-hero {
                padding: 22px;
            }

            .form-hero h1 {
                font-size: 28px;
            }

            .hero-link {
                width: fit-content;
            }

            .cockpit-copy {
                min-height: 0;
                padding: 24px;
            }

            .cockpit-copy h1 {
                font-size: 31px;
            }

            .command-item {
                grid-template-columns: 42px minmax(0, 1fr);
            }

            .command-item > i {
                display: none;
            }

            .portal-banner {
                padding: 22px;
            }

            .portal-banner h1 {
                font-size: 30px;
            }

            .teacher-hero-card {
                padding: 22px;
            }

            .teacher-hero-copy h1 {
                font-size: 30px;
            }

            .student-cover {
                padding: 22px;
            }

            .student-cover h1 {
                font-size: 30px;
            }
        }
    
        /* Final Add Student orange theme override */
        .form-hero.student-form-theme {
            background: linear-gradient(135deg, #fff7ed 0%, #fdba74 52%, #f97316 100%) !important;
            border: 1px solid #fed7aa !important;
            box-shadow: 0 22px 48px rgba(146, 64, 14, 0.18) !important;
        }

        .form-hero.student-form-theme .eyebrow,
        .form-hero.student-form-theme h1 {
            color: #111827 !important;
        }

        .form-hero.student-form-theme p {
            color: #3f2a12 !important;
        }

        .form-hero.student-form-theme .hero-link {
            color: #111827 !important;
            background: rgba(255, 247, 237, 0.62) !important;
            border-color: rgba(17, 24, 39, 0.18) !important;
        }

        .form-hero.student-form-theme .hero-link:hover {
            background: rgba(17, 24, 39, 0.10) !important;
        }

        .form-card {
            border-color: #fed7aa !important;
        }

        .form-card .panel-title span,
        .field-control i {
            color: #c2410c !important;
        }

        .field-control input,
        .field-control select {
            border-color: #fdba74 !important;
            background: #fffaf5 !important;
        }

        .field-control input:focus,
        .field-control select:focus {
            border-color: #f97316 !important;
            box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.16) !important;
        }

        .form-actions {
            border-top-color: #fed7aa !important;
        }

        .form-actions .btn-primary {
            background: #111827 !important;
            box-shadow: 0 12px 22px rgba(17, 24, 39, 0.18) !important;
        }

        .form-actions .btn-primary:hover {
            background: #1f2937 !important;
        }

        .form-actions .btn-secondary {
            background: #f97316 !important;
        }

        .form-side-card:not(.teacher-card) {
            background: #fff7ed !important;
            border-color: #fed7aa !important;
        }

        .form-side-card:not(.teacher-card) > i {
            color: #111827 !important;
            background: #fed7aa !important;
        }

        .form-side-card:not(.teacher-card) h2 {
            color: #111827 !important;
        }
    
        /* Split-panel Add Student redesign */
        .container:has(.student-enrollment-interface) {
            max-width: 1120px !important;
        }

        .student-enrollment-interface {
            display: grid;
            grid-template-columns: 320px minmax(0, 1fr);
            min-height: 620px;
            overflow: hidden;
            border-radius: 22px;
            background: #ffffff;
            border: 1px solid #fed7aa;
            box-shadow: 0 26px 60px rgba(146, 64, 14, 0.16);
        }

        .enrollment-side {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            gap: 28px;
            padding: 30px;
            background:
                linear-gradient(160deg, #111827 0%, #1f2937 46%, #f97316 100%);
            color: #ffffff;
        }

        .enrollment-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            width: fit-content;
            min-height: 40px;
            padding: 0 13px;
            border-radius: 11px;
            color: #111827;
            background: #ffedd5;
            border: 1px solid rgba(255, 237, 213, 0.72);
            text-decoration: none;
            font-weight: 900;
        }

        .enrollment-back:hover {
            background: #fed7aa;
        }

        .enrollment-side-copy span,
        .enrollment-form-heading span {
            display: block;
            margin-bottom: 8px;
            color: #fdba74;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .enrollment-side-copy h1 {
            margin: 0 0 12px;
            color: #ffffff;
            font-size: 38px;
            line-height: 1.08;
        }

        .enrollment-side-copy p {
            margin: 0;
            color: #ffedd5;
        }

        .enrollment-checklist {
            display: grid;
            gap: 12px;
        }

        .enrollment-checklist div {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            padding: 12px;
            border-radius: 13px;
            background: rgba(255, 255, 255, 0.10);
            border: 1px solid rgba(255, 255, 255, 0.13);
            color: #fff7ed;
            font-weight: 800;
            line-height: 1.45;
        }

        .enrollment-checklist i {
            color: #fdba74;
            font-size: 18px;
            margin-top: 2px;
        }

        .enrollment-form-panel {
            padding: 30px;
        }

        .enrollment-form-heading {
            margin-bottom: 18px;
        }

        .enrollment-form-heading h2 {
            margin: 0;
            color: #111827;
            font-size: 24px;
        }

        .enrollment-grid {
            gap: 16px !important;
        }

        .student-enrollment-interface .field-group label {
            color: #111827;
            font-weight: 900;
        }

        .student-enrollment-interface .field-control i {
            color: #ea580c !important;
        }

        .student-enrollment-interface .field-control input,
        .student-enrollment-interface .field-control select {
            min-height: 48px;
            background: #fffaf5 !important;
            border-color: #fdba74 !important;
            border-radius: 13px;
        }

        .student-enrollment-interface .field-control input:focus,
        .student-enrollment-interface .field-control select:focus {
            border-color: #f97316 !important;
            box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.16) !important;
        }

        .enrollment-actions {
            margin-top: 18px !important;
            border-top-color: #fed7aa !important;
        }

        .enrollment-actions .btn {
            border-radius: 12px !important;
            min-height: 44px;
            padding: 11px 16px !important;
            font-weight: 900;
        }

        .enrollment-actions .btn-primary {
            background: #111827 !important;
            box-shadow: 0 12px 22px rgba(17, 24, 39, 0.18) !important;
        }

        .enrollment-actions .btn-secondary {
            background: #f97316 !important;
        }

        @media (max-width: 860px) {
            .student-enrollment-interface {
                grid-template-columns: 1fr;
            }

            .enrollment-side {
                padding: 24px;
            }

            .enrollment-form-panel {
                padding: 24px;
            }
        }
    
        /* Dark blue + black Add Student redesign override */
        nav {
            background: #0b1220 !important;
            box-shadow: 0 10px 24px rgba(11, 18, 32, 0.22) !important;
        }

        nav a:hover,
        nav button:hover {
            background: rgba(96, 165, 250, 0.16) !important;
        }

        .student-enrollment-interface {
            border-color: #1e3a8a !important;
            box-shadow: 0 26px 60px rgba(15, 23, 42, 0.18) !important;
        }

        .enrollment-side {
            background:
                linear-gradient(160deg, #020617 0%, #0f172a 42%, #1d4ed8 100%) !important;
        }

        .enrollment-back {
            color: #e0f2fe !important;
            background: rgba(15, 23, 42, 0.86) !important;
            border-color: rgba(147, 197, 253, 0.34) !important;
        }

        .enrollment-back:hover {
            background: #1e3a8a !important;
        }

        .enrollment-side-copy span,
        .enrollment-form-heading span {
            color: #60a5fa !important;
        }

        .enrollment-side-copy p {
            color: #dbeafe !important;
        }

        .enrollment-checklist div {
            background: rgba(15, 23, 42, 0.58) !important;
            border-color: rgba(147, 197, 253, 0.20) !important;
            color: #eff6ff !important;
        }

        .enrollment-checklist i {
            color: #93c5fd !important;
        }

        .student-enrollment-interface .field-control i {
            color: #1d4ed8 !important;
        }

        .student-enrollment-interface .field-control input,
        .student-enrollment-interface .field-control select {
            background: #f8fbff !important;
            border-color: #93c5fd !important;
        }

        .student-enrollment-interface .field-control input:focus,
        .student-enrollment-interface .field-control select:focus {
            border-color: #1d4ed8 !important;
            box-shadow: 0 0 0 4px rgba(29, 78, 216, 0.15) !important;
        }

        .enrollment-actions {
            border-top-color: #bfdbfe !important;
        }

        .enrollment-actions .btn-primary {
            background: #020617 !important;
            color: #ffffff !important;
            box-shadow: 0 12px 22px rgba(2, 6, 23, 0.20) !important;
        }

        .enrollment-actions .btn-primary:hover {
            background: #111827 !important;
        }

        .enrollment-actions .btn-secondary {
            background: #1d4ed8 !important;
            color: #ffffff !important;
        }

        .enrollment-actions .btn-secondary:hover {
            background: #1e40af !important;
        }
    
        /* Command-style Add Student interface */
        .container:has(.student-command-interface) {
            max-width: 1180px !important;
        }

        .student-command-interface {
            display: grid;
            gap: 16px;
        }

        .student-command-header {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            align-items: center;
            padding: 28px;
            border-radius: 20px;
            background:
                linear-gradient(135deg, #020617 0%, #0f172a 48%, #1d4ed8 100%);
            box-shadow: 0 22px 48px rgba(15, 23, 42, 0.20);
        }

        .student-command-header span,
        .command-section-title span {
            display: block;
            color: #93c5fd;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .student-command-header h1 {
            margin: 8px 0;
            color: #ffffff;
            font-size: 38px;
        }

        .student-command-header p {
            margin: 0;
            color: #dbeafe;
        }

        .command-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            flex: 0 0 auto;
            min-height: 42px;
            padding: 0 14px;
            border-radius: 12px;
            background: rgba(15, 23, 42, 0.74);
            border: 1px solid rgba(147, 197, 253, 0.34);
            color: #ffffff;
            text-decoration: none;
            font-weight: 900;
        }

        .command-back:hover {
            background: #1e3a8a;
        }

        .student-command-form {
            display: grid;
            gap: 14px;
            margin-top: 0;
        }

        .command-section {
            display: grid;
            grid-template-columns: 210px minmax(0, 1fr);
            gap: 20px;
            padding: 22px;
            border-radius: 18px;
            background: #ffffff;
            border: 1px solid #bfdbfe;
            box-shadow: 0 14px 34px rgba(15, 23, 42, 0.08);
        }

        .command-section-title {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px;
            border-radius: 14px;
            background: #eff6ff;
            border: 1px solid #dbeafe;
            height: fit-content;
        }

        .command-section-title > i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 11px;
            background: #020617;
            color: #93c5fd;
            font-size: 19px;
            flex: 0 0 auto;
        }

        .command-section-title h2 {
            margin: 4px 0 0;
            color: #0f172a;
            font-size: 18px;
        }

        .command-grid {
            gap: 14px 16px !important;
        }

        .student-command-interface .field-control i {
            color: #1d4ed8 !important;
        }

        .student-command-interface .field-control input,
        .student-command-interface .field-control select {
            background: #f8fbff !important;
            border-color: #93c5fd !important;
            border-radius: 12px !important;
        }

        .student-command-interface .field-control input:focus,
        .student-command-interface .field-control select:focus {
            border-color: #1d4ed8 !important;
            box-shadow: 0 0 0 4px rgba(29, 78, 216, 0.15) !important;
        }

        .command-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            justify-content: flex-end;
            padding: 18px 0 0;
        }

        .command-actions .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            border-radius: 12px;
            padding: 11px 16px;
            font-weight: 900;
        }

        .command-actions .btn-primary {
            background: #020617 !important;
            color: #ffffff !important;
            box-shadow: 0 12px 22px rgba(2, 6, 23, 0.20);
        }

        .command-actions .btn-secondary {
            background: #1d4ed8 !important;
            color: #ffffff !important;
        }

        @media (max-width: 860px) {
            .student-command-header,
            .command-section {
                grid-template-columns: 1fr;
            }

            .student-command-header {
                display: grid;
                padding: 22px;
            }

            .command-section {
                padding: 18px;
            }

            .command-actions {
                justify-content: flex-start;
            }
        }

        /* Light purple Add Student command interface override */
        nav {
            background: #2e1065 !important;
            box-shadow: 0 10px 24px rgba(46, 16, 101, 0.22) !important;
        }

        nav a:hover,
        nav button:hover {
            background: rgba(216, 180, 254, 0.18) !important;
        }

        .student-command-header {
            background:
                linear-gradient(135deg, #f5f3ff 0%, #ddd6fe 48%, #a78bfa 100%) !important;
            border: 1px solid #c4b5fd !important;
            box-shadow: 0 22px 48px rgba(109, 40, 217, 0.16) !important;
        }

        .student-command-header span,
        .command-section-title span {
            color: #6d28d9 !important;
        }

        .student-command-header h1 {
            color: #2e1065 !important;
        }

        .student-command-header p {
            color: #4c1d95 !important;
        }

        .command-back {
            background: rgba(46, 16, 101, 0.10) !important;
            border-color: rgba(76, 29, 149, 0.22) !important;
            color: #2e1065 !important;
        }

        .command-back:hover {
            background: rgba(76, 29, 149, 0.18) !important;
        }

        .command-section {
            border-color: #c4b5fd !important;
            box-shadow: 0 14px 34px rgba(109, 40, 217, 0.08) !important;
        }

        .command-section-title {
            background: #f5f3ff !important;
            border-color: #ddd6fe !important;
        }

        .command-section-title > i {
            background: #2e1065 !important;
            color: #ddd6fe !important;
        }

        .command-section-title h2 {
            color: #2e1065 !important;
        }

        .student-command-interface .field-control i {
            color: #7c3aed !important;
        }

        .student-command-interface .field-control input,
        .student-command-interface .field-control select {
            background: #fbfaff !important;
            border-color: #c4b5fd !important;
        }

        .student-command-interface .field-control input:focus,
        .student-command-interface .field-control select:focus {
            border-color: #7c3aed !important;
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.15) !important;
        }

        .command-actions .btn-primary {
            background: #2e1065 !important;
            color: #ffffff !important;
            box-shadow: 0 12px 22px rgba(46, 16, 101, 0.20) !important;
        }

        .command-actions .btn-primary:hover {
            background: #4c1d95 !important;
        }

        .command-actions .btn-secondary {
            background: #8b5cf6 !important;
            color: #ffffff !important;
        }

        .command-actions .btn-secondary:hover {
            background: #7c3aed !important;
        }

        /* Enrollment studio Add Student interface */
        .container:has(.student-studio-interface) {
            max-width: 1180px !important;
        }

        .student-studio-interface {
            display: grid;
            gap: 18px;
        }

        .studio-topbar {
            display: grid;
            grid-template-columns: auto minmax(0, 1fr) auto;
            gap: 18px;
            align-items: center;
            padding: 22px;
            border-radius: 20px;
            background: linear-gradient(135deg, #faf5ff 0%, #ede9fe 50%, #c4b5fd 100%);
            border: 1px solid #c4b5fd;
            box-shadow: 0 20px 44px rgba(109, 40, 217, 0.14);
        }

        .studio-topbar span,
        .studio-heading span {
            color: #6d28d9;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .studio-topbar h1 {
            margin: 6px 0 0;
            color: #2e1065;
            font-size: 32px;
        }

        .studio-back,
        .studio-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            min-height: 42px;
            padding: 0 14px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 900;
            white-space: nowrap;
        }

        .studio-back {
            color: #2e1065;
            background: rgba(255, 255, 255, 0.62);
            border: 1px solid rgba(76, 29, 149, 0.18);
        }

        .studio-back:hover {
            background: rgba(76, 29, 149, 0.12);
        }

        .studio-pill {
            color: #ffffff;
            background: #2e1065;
        }

        .studio-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 310px;
            gap: 18px;
            align-items: start;
        }

        .studio-form-card,
        .studio-side-panel {
            border: 1px solid #ddd6fe;
            border-radius: 20px;
            background: #ffffff;
            box-shadow: 0 14px 34px rgba(109, 40, 217, 0.08);
        }

        .studio-form-card {
            padding: 24px;
        }

        .studio-heading {
            margin-bottom: 18px;
        }

        .studio-heading h2 {
            margin: 6px 0;
            color: #2e1065;
            font-size: 24px;
        }

        .studio-heading p {
            margin: 0;
            color: #64748b;
        }

        .studio-form {
            display: grid;
            gap: 16px;
            margin-top: 0;
        }

        .studio-section {
            display: grid;
            gap: 12px;
            padding: 16px;
            border-radius: 16px;
            background: #fbfaff;
            border: 1px solid #ede9fe;
        }

        .studio-section-label {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            width: fit-content;
            color: #4c1d95;
            font-weight: 900;
        }

        .studio-section-label i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: #2e1065;
            color: #ddd6fe;
        }

        .studio-field-grid {
            gap: 14px 16px !important;
        }

        .student-studio-interface .field-control i {
            color: #7c3aed !important;
        }

        .student-studio-interface .field-control input,
        .student-studio-interface .field-control select {
            background: #ffffff !important;
            border-color: #c4b5fd !important;
            border-radius: 12px !important;
        }

        .student-studio-interface .field-control input:focus,
        .student-studio-interface .field-control select:focus {
            border-color: #7c3aed !important;
            box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.15) !important;
        }

        .studio-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        .studio-actions .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 11px 16px;
            border-radius: 12px;
            font-weight: 900;
        }

        .studio-actions .btn-primary {
            background: #2e1065 !important;
            color: #ffffff !important;
            box-shadow: 0 12px 22px rgba(46, 16, 101, 0.20);
        }

        .studio-actions .btn-secondary {
            background: #8b5cf6 !important;
            color: #ffffff !important;
        }

        .studio-side-panel {
            display: grid;
            gap: 12px;
            padding: 24px;
            background: #f5f3ff;
            position: sticky;
            top: 20px;
        }

        .studio-side-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 46px;
            height: 46px;
            border-radius: 13px;
            color: #ddd6fe;
            background: #2e1065;
            font-size: 22px;
        }

        .studio-side-panel h2 {
            margin: 0;
            color: #2e1065;
        }

        .studio-side-panel p {
            margin: 0;
        }

        .studio-checklist {
            display: grid;
            gap: 10px;
            margin-top: 6px;
        }

        .studio-checklist div {
            display: flex;
            gap: 9px;
            align-items: flex-start;
            color: #4c1d95;
            font-weight: 800;
            line-height: 1.45;
        }

        .studio-checklist i {
            color: #7c3aed;
            margin-top: 2px;
        }

        @media (max-width: 860px) {
            .studio-topbar,
            .studio-grid {
                grid-template-columns: 1fr;
            }

            .studio-side-panel {
                position: static;
            }

            .studio-actions {
                justify-content: flex-start;
            }
        }

    
        /* Light purple Admin Dashboard console */
        .container:has(.admin-purple-console) {
            max-width: 1120px !important;
        }

        .admin-purple-console {
            display: grid;
            gap: 16px;
        }

        .admin-purple-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 240px;
            gap: 18px;
            align-items: stretch;
            padding: 28px;
            border-radius: 20px;
            background: linear-gradient(135deg, #f5f3ff 0%, #ddd6fe 52%, #a78bfa 100%);
            border: 1px solid #c4b5fd;
            box-shadow: 0 22px 48px rgba(109, 40, 217, 0.16);
        }

        .admin-purple-hero span,
        .admin-purple-heading span,
        .admin-purple-stats span {
            color: #6d28d9;
            font-size: 12px;
            font-weight: 900;
            letter-spacing: 0.14em;
            text-transform: uppercase;
        }

        .admin-purple-hero h1 {
            margin: 10px 0;
            color: #2e1065;
            font-size: 38px;
        }

        .admin-purple-hero p {
            max-width: 640px;
            margin: 0;
            color: #4c1d95;
        }

        .admin-purple-badge {
            display: grid;
            align-content: center;
            gap: 8px;
            min-height: 142px;
            padding: 18px;
            border-radius: 16px;
            background: rgba(46, 16, 101, 0.10);
            border: 1px solid rgba(76, 29, 149, 0.18);
            color: #2e1065;
        }

        .admin-purple-badge i {
            font-size: 26px;
        }

        .admin-purple-badge strong {
            font-size: 20px;
        }

        .admin-purple-badge small {
            color: #6d28d9;
            font-weight: 800;
        }

        .admin-purple-stats {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
        }

        .admin-purple-stats div,
        .admin-purple-panel {
            border: 1px solid #ddd6fe;
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 14px 34px rgba(109, 40, 217, 0.08);
        }

        .admin-purple-stats div {
            display: grid;
            gap: 8px;
            padding: 18px;
        }

        .admin-purple-stats i,
        .admin-purple-actions > a > i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: #f5f3ff;
            color: #7c3aed;
            font-size: 20px;
        }

        .admin-purple-stats strong {
            color: #2e1065;
            font-size: 30px;
            line-height: 1;
        }

        .admin-purple-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) 310px;
            gap: 16px;
            align-items: start;
        }

        .admin-purple-panel {
            padding: 22px;
        }

        .admin-purple-heading {
            margin-bottom: 16px;
        }

        .admin-purple-heading h2 {
            margin: 5px 0 0;
            color: #2e1065;
        }

        .admin-purple-actions {
            display: grid;
            gap: 12px;
        }

        .admin-purple-actions a {
            display: grid;
            grid-template-columns: 42px minmax(0, 1fr);
            gap: 14px;
            align-items: center;
            padding: 15px;
            border-radius: 14px;
            border: 1px solid #ede9fe;
            background: #fbfaff;
            color: #0f172a;
            text-decoration: none;
            transition: transform 150ms ease, box-shadow 150ms ease, border-color 150ms ease;
        }

        .admin-purple-actions a:hover {
            transform: translateY(-2px);
            border-color: #c4b5fd;
            box-shadow: 0 12px 24px rgba(109, 40, 217, 0.10);
        }

        .admin-purple-actions strong {
            color: #2e1065;
            font-size: 16px;
        }

        .admin-purple-actions span {
            display: block;
            margin-top: 3px;
            color: #64748b;
            font-size: 13px;
        }

        .admin-purple-side {
            background: #f5f3ff;
        }

        .admin-purple-checks {
            display: grid;
            gap: 12px;
        }

        .admin-purple-checks div {
            display: flex;
            gap: 10px;
            align-items: flex-start;
            color: #4c1d95;
            font-weight: 800;
            line-height: 1.5;
        }

        .admin-purple-checks i {
            color: #7c3aed;
            margin-top: 2px;
        }

        @media (max-width: 860px) {
            .admin-purple-hero,
            .admin-purple-stats,
            .admin-purple-grid {
                grid-template-columns: 1fr;
            }
        }
        /* 2026 UI refresh */
        :root {
            --ink: #172033;
            --muted: #667085;
            --line: #d7dee8;
            --paper: #ffffff;
            --wash: #f4f7f2;
            --navy: #13233a;
            --teal: #0f766e;
            --coral: #d85a3a;
            --gold: #b7791f;
            --green: #15803d;
            --red: #b42318;
            --shadow: 0 16px 36px rgba(23, 32, 51, 0.10);
        }

        * {
            font-family: Inter, "Segoe UI", Arial, sans-serif !important;
            letter-spacing: 0 !important;
        }

        body {
            background:
                linear-gradient(180deg, #eef3ed 0%, #f8faf7 42%, #eef4f6 100%) !important;
            color: var(--ink) !important;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(19, 35, 58, 0.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(19, 35, 58, 0.035) 1px, transparent 1px);
            background-size: 36px 36px;
            mask-image: linear-gradient(180deg, rgba(0, 0, 0, 0.55), transparent 72%);
        }

        nav {
            position: sticky !important;
            top: 0;
            z-index: 20;
            min-height: 68px;
            padding: 12px clamp(16px, 4vw, 42px) !important;
            background: rgba(255, 255, 255, 0.88) !important;
            border-bottom: 1px solid rgba(19, 35, 58, 0.12) !important;
            box-shadow: 0 10px 30px rgba(23, 32, 51, 0.08) !important;
            backdrop-filter: blur(16px);
        }

        .nav-brand {
            min-height: 42px;
            padding: 0 14px;
            border-radius: 8px;
            background: var(--navy);
            color: #ffffff !important;
            box-shadow: 0 10px 20px rgba(19, 35, 58, 0.18);
        }

        nav a,
        nav button {
            min-height: 38px;
            display: inline-flex !important;
            align-items: center;
            color: #344054 !important;
            border-radius: 8px !important;
            font-weight: 800 !important;
        }

        nav a:hover,
        nav button:hover {
            background: #e8f3ef !important;
            color: var(--teal) !important;
        }

        .container {
            position: relative;
            width: min(1180px, calc(100% - 32px)) !important;
            margin: 28px auto 52px !important;
            padding: 0 !important;
        }

        h1 {
            color: var(--ink) !important;
            font-size: clamp(30px, 4vw, 42px) !important;
            line-height: 1.08 !important;
            margin-bottom: 16px !important;
        }

        h2 {
            color: var(--ink) !important;
            font-size: 21px !important;
            line-height: 1.25 !important;
        }

        p {
            color: var(--muted) !important;
        }

        .btn,
        button.btn,
        .login-btn {
            display: inline-flex !important;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 10px 14px !important;
            border-radius: 8px !important;
            font-weight: 850 !important;
            border: 1px solid transparent !important;
            box-shadow: none !important;
            transition: transform 140ms ease, box-shadow 140ms ease, border-color 140ms ease, background 140ms ease;
        }

        .btn:hover,
        button:hover {
            transform: translateY(-1px);
        }

        .btn-primary,
        .command-actions .btn-primary,
        .studio-actions .btn-primary {
            background: var(--teal) !important;
            color: #ffffff !important;
        }

        .btn-primary:hover {
            background: #115e59 !important;
        }

        .btn-success {
            background: var(--green) !important;
            color: #ffffff !important;
        }

        .btn-warning {
            background: var(--gold) !important;
            color: #ffffff !important;
        }

        .btn-danger {
            background: var(--red) !important;
            color: #ffffff !important;
        }

        .btn-secondary,
        .command-actions .btn-secondary,
        .studio-actions .btn-secondary {
            background: #eef2f6 !important;
            color: var(--ink) !important;
            border-color: var(--line) !important;
        }

        .card,
        .ajax-card,
        .form-card,
        .form-side-card,
        .admin-work-panel,
        .admin-side-panel,
        .admin-metric,
        .teacher-panel,
        .teacher-ready-panel,
        .student-panel,
        .student-note-panel,
        .studio-form-card,
        .studio-side-panel,
        .admin-panel,
        .stat-card,
        .workspace-panel,
        .metric-card,
        .admin-purple-panel,
        .admin-purple-stats div {
            border: 1px solid var(--line) !important;
            border-radius: 8px !important;
            background: rgba(255, 255, 255, 0.94) !important;
            box-shadow: var(--shadow) !important;
        }

        .dashboard-hero,
        .admin-hero,
        .role-hero,
        .admin-command-hero,
        .teacher-hero,
        .student-hero,
        .form-hero,
        .student-command-header,
        .studio-topbar,
        .admin-purple-hero,
        .ajax-toolbar {
            border: 1px solid rgba(19, 35, 58, 0.14) !important;
            border-radius: 8px !important;
            background:
                linear-gradient(135deg, rgba(19, 35, 58, 0.96), rgba(15, 118, 110, 0.90) 58%, rgba(216, 90, 58, 0.84)) !important;
            color: #ffffff !important;
            box-shadow: 0 18px 42px rgba(19, 35, 58, 0.20) !important;
        }

        .dashboard-hero *,
        .admin-hero *,
        .role-hero *,
        .admin-command-hero *,
        .teacher-hero *,
        .student-hero *,
        .form-hero *,
        .student-command-header *,
        .studio-topbar *,
        .admin-purple-hero *,
        .ajax-toolbar * {
            color: #ffffff !important;
        }

        .eyebrow,
        .dash-eyebrow,
        .teacher-eyebrow,
        .student-eyebrow,
        .admin-kicker,
        .panel-title span,
        .panel-heading span,
        .section-heading span,
        .studio-heading span,
        .studio-topbar span,
        .ajax-card > h2:first-child,
        .student-panel-heading span,
        .teacher-panel-heading span {
            color: var(--coral) !important;
            font-weight: 900 !important;
            text-transform: uppercase;
        }

        .dashboard-hero .eyebrow,
        .admin-command-hero .dash-eyebrow,
        .teacher-hero .teacher-eyebrow,
        .student-hero .student-eyebrow,
        .studio-topbar span {
            color: #ffd9c9 !important;
        }

        .role-badge,
        .admin-date-card,
        .teacher-badge,
        .student-status-card,
        .hero-status,
        .studio-pill,
        .admin-purple-badge {
            border-radius: 8px !important;
            border: 1px solid rgba(255, 255, 255, 0.22) !important;
            background: rgba(255, 255, 255, 0.13) !important;
        }

        table {
            overflow: hidden;
            border: 1px solid var(--line) !important;
            border-radius: 8px;
            background: var(--paper);
            box-shadow: var(--shadow);
        }

        table,
        th,
        td {
            border-color: #e4e9f0 !important;
        }

        th {
            background: #13233a !important;
            color: #ffffff !important;
            font-size: 12px;
            text-transform: uppercase;
        }

        td {
            background: rgba(255, 255, 255, 0.98);
            color: #344054;
        }

        tbody tr:nth-child(even) td {
            background: #f8faf7;
        }

        input,
        select,
        textarea {
            min-height: 44px;
            border-radius: 8px !important;
            border: 1px solid #cfd8e3 !important;
            background: #ffffff !important;
            color: var(--ink) !important;
            outline: none;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--teal) !important;
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.14) !important;
        }

        label {
            color: #344054 !important;
            font-weight: 850 !important;
        }

        .field-control i,
        .admin-metric i,
        .admin-action i,
        .teacher-status i,
        .student-detail i,
        .studio-section-label i,
        .tool-card i,
        .action-tile i {
            background: #e8f3ef !important;
            color: var(--teal) !important;
            border-radius: 8px !important;
        }

        .admin-action,
        .tool-card,
        .action-tile,
        .teacher-status,
        .student-detail,
        .studio-section,
        .system-list div {
            border-radius: 8px !important;
            background: #f8faf7 !important;
            border-color: var(--line) !important;
        }

        .admin-action:hover,
        .tool-card:hover,
        .action-tile:hover {
            border-color: var(--teal) !important;
            box-shadow: 0 12px 26px rgba(15, 118, 110, 0.13) !important;
        }

        .alert {
            border-radius: 8px !important;
            border: 1px solid transparent;
        }

        .alert-success {
            background: #ecfdf3 !important;
            color: #027a48 !important;
            border-color: #abefc6;
        }

        .alert-error,
        .form-errors {
            background: #fff1ed !important;
            color: var(--red) !important;
            border: 1px solid #fecdca !important;
        }

        .pagination {
            margin-top: 18px;
        }

        @media (max-width: 720px) {
            nav {
                align-items: stretch;
            }

            nav a,
            nav button,
            .nav-brand {
                width: 100%;
                justify-content: center;
            }

            .actions,
            .ajax-actions,
            .form-actions,
            .studio-actions {
                flex-wrap: wrap !important;
            }

            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>

    <nav>
        <span class="nav-brand">RM</span>

        @if(session('user_role') === 'admin')
            <a href="{{ route('admin.dashboard', [], false) }}">Admin Dashboard</a>
            <a href="/degrees">Degrees</a>
            <a href="/students">Students</a>
            <a href="{{ route('teachers.index', [], false) }}">Teachers</a>
        @elseif(session('user_role') === 'teacher')
            <a href="{{ route('teacher.dashboard', [], false) }}">Teacher Dashboard</a>
        @elseif(session('user_role') === 'student')
            <a href="{{ route('student.dashboard', [], false) }}">Student Dashboard</a>
        @endif

        @if(session('user_account_id'))
            <span class="nav-spacer"></span>
            <form action="{{ route('logout') }}" method="POST" style="margin:0;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @endif
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @vite('resources/js/app.js')
    @yield('scripts')
</body>
</html>
