<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | RM Portal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --ink: #172033;
            --muted: #667085;
            --line: #d9e1ea;
            --paper: #ffffff;
            --navy: #111827;
            --teal: #1f7a8c;
            --coral: #e76f51;
            --gold: #f4a261;
            --wash: #f6f1ea;
            --shadow: 0 28px 80px rgba(17, 24, 39, 0.20);
        }

        * {
            box-sizing: border-box;
            font-family: Inter, "Segoe UI", Arial, sans-serif;
            letter-spacing: 0;
        }

        body {
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(14px, 3vw, 34px);
            background:
                linear-gradient(120deg, rgba(17, 24, 39, 0.88), rgba(31, 122, 140, 0.70)),
                url("https://images.unsplash.com/photo-1523580846011-d3a5bc25702b?auto=format&fit=crop&w=1800&q=80") center/cover;
            color: var(--ink);
        }

        .login-shell {
            width: min(1120px, 100%);
            min-height: 650px;
            display: grid;
            grid-template-columns: 420px minmax(0, 1fr);
            gap: 18px;
            overflow: hidden;
            padding: 18px;
            border: 1px solid rgba(255, 255, 255, 0.24);
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.20);
            box-shadow: var(--shadow);
            backdrop-filter: blur(18px);
        }

        .portal-panel {
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100%;
            padding: clamp(28px, 5vw, 54px);
            color: #ffffff;
            border-radius: 14px;
            background: linear-gradient(180deg, rgba(17, 24, 39, 0.96), rgba(31, 122, 140, 0.94));
            overflow: hidden;
        }

        .portal-panel::after {
            content: "";
            position: absolute;
            right: -80px;
            bottom: -90px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(244, 162, 97, 0.24);
        }

        .brand-mark {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            position: relative;
            z-index: 1;
            width: fit-content;
            min-height: 48px;
            padding: 0 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.26);
            font-weight: 900;
        }

        .portal-copy {
            position: relative;
            z-index: 1;
        }

        .portal-copy h1 {
            max-width: 350px;
            margin: 0 0 14px;
            color: #ffffff;
            font-size: clamp(36px, 5vw, 56px);
            line-height: 1.02;
        }

        .portal-copy p {
            max-width: 500px;
            margin: 0;
            color: #f1f7f6;
            font-size: 16px;
            line-height: 1.7;
        }

        .role-row {
            display: grid;
            grid-template-columns: 1fr;
            gap: 10px;
            margin-top: 30px;
        }

        .role-row div {
            display: flex;
            align-items: center;
            gap: 12px;
            min-height: 58px;
            padding: 13px 14px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255, 255, 255, 0.18);
            font-weight: 850;
        }

        .role-row i {
            color: #ffe5d2;
            font-size: 21px;
        }

        .form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: clamp(30px, 6vw, 70px);
            border-radius: 14px;
            background: var(--paper);
        }

        .form-panel h2 {
            margin: 0 0 8px;
            color: var(--ink);
            font-size: 40px;
            line-height: 1.1;
        }

        .form-panel > p {
            margin: 0;
            color: var(--muted);
            line-height: 1.6;
        }

        .alert-error {
            margin-top: 22px;
            padding: 13px 15px;
            border-radius: 8px;
            background: #fff1ed;
            border: 1px solid #fecdca;
            color: #b42318;
            font-size: 14px;
            font-weight: 850;
        }

        form {
            display: grid;
            gap: 17px;
            margin-top: 28px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #344054;
            font-size: 14px;
            font-weight: 850;
        }

        .field {
            position: relative;
        }

        .field i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: var(--coral);
        }

        input {
            width: 100%;
            min-height: 54px;
            padding: 0 16px 0 46px;
            border: 1px solid #cfd8e3;
            border-radius: 14px;
            background: #f9fbfc;
            color: var(--ink);
            font-size: 15px;
            outline: none;
        }

        input:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 4px rgba(31, 122, 140, 0.14);
        }

        .login-btn {
            min-height: 54px;
            border: 0;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--teal), #145c6a);
            color: #ffffff;
            cursor: pointer;
            font-size: 15px;
            font-weight: 900;
            box-shadow: 0 14px 26px rgba(31, 122, 140, 0.22);
        }

        .login-btn:hover {
            background: #115e59;
        }

        .login-help {
            margin-top: 18px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
            color: var(--muted);
            font-size: 13px;
            line-height: 1.5;
        }

        .login-help i {
            color: var(--coral);
            margin-top: 2px;
        }

        @media (max-width: 900px) {
            .login-shell {
                grid-template-columns: 1fr;
                padding: 12px;
            }

            .portal-panel {
                min-height: 400px;
            }
        }

        @media (max-width: 620px) {
            .role-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <main class="login-shell">
        <section class="portal-panel">
            <div class="brand-mark"><i class="bi bi-buildings-fill"></i> RM Portal</div>

            <div class="portal-copy">
                <h1>Records made easier.</h1>
                <p>Open the right workspace for admins, teachers, and students in one secure RM portal.</p>

                <div class="role-row">
                    <div><i class="bi bi-shield-check"></i>Admin records</div>
                    <div><i class="bi bi-person-video3"></i>Teacher access</div>
                    <div><i class="bi bi-mortarboard"></i>Student profile</div>
                </div>
            </div>
        </section>

        <section class="form-panel">
            <h2>Sign in</h2>
            <p>Use your assigned username and password.</p>

            @if(!empty($msg))
                <div class="alert-error">{{ $msg }}</div>
            @endif

            <form action="/" method="POST">
                @csrf

                <div>
                    <label for="username">Username</label>
                    <div class="field">
                        <i class="bi bi-person-fill"></i>
                        <input id="username" type="text" name="username" value="{{ old('username') }}" placeholder="Enter username" autocomplete="username" required>
                    </div>
                </div>

                <div>
                    <label for="password">Password</label>
                    <div class="field">
                        <i class="bi bi-lock-fill"></i>
                        <input id="password" type="password" name="password" placeholder="Enter password" autocomplete="current-password" required>
                    </div>
                </div>

                <button type="submit" class="login-btn">Open Dashboard</button>
            </form>

            <div class="login-help">
                <i class="bi bi-info-circle-fill"></i>
                <span>Admin, teacher, and student accounts are supported.</span>
            </div>
        </section>
    </main>
</body>
</html>
