<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
            background: #f3f4f6;
            color: #1f2937;
            min-height: 100vh;
            line-height: 1.5;
        }

        /* ---------- NAVBAR ---------- */
        .navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .navbar-inner {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
            height: 64px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .brand {
            font-size: 18px;
            font-weight: 700;
            color: #1f2937;
            text-decoration: none;
        }

        .brand:hover {
            color: #2563eb;
        }

        .nav-links {
            display: flex;
            gap: 4px;
        }

        .nav-links a {
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            color: #4b5563;
            text-decoration: none;
            transition: background 0.15s, color 0.15s;
        }

        .nav-links a:hover {
            background: #f3f4f6;
            color: #2563eb;
        }

        .nav-links a.active {
            background: #eff6ff;
            color: #2563eb;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .user-info {
            text-align: right;
        }

        .user-name {
            font-size: 14px;
            font-weight: 500;
            color: #1f2937;
        }

        .user-role {
            font-size: 12px;
            color: #6b7280;
        }

        .btn-logout {
            padding: 8px 16px;
            background: #374151;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.15s;
        }

        .btn-logout:hover {
            background: #1f2937;
        }

        /* ---------- MAIN ---------- */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 32px 20px;
        }

        /* ---------- ALERTS ---------- */
        .alert {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        .alert ul {
            margin: 0;
            padding-left: 18px;
        }

        /* ---------- HEADINGS ---------- */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-title {
            font-size: 22px;
            font-weight: 700;
            color: #111827;
        }

        .page-subtitle {
            font-size: 14px;
            color: #6b7280;
            margin-top: 2px;
        }

        /* ---------- CARDS ---------- */
        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        .card-narrow {
            max-width: 520px;
            margin: 0 auto;
        }

        /* ---------- BUTTONS ---------- */
        .btn {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.15s, color 0.15s;
        }

        .btn-primary {
            background: #2563eb;
            color: #ffffff;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            background: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #f9fafb;
        }

        .btn-link {
            background: none;
            color: #6b7280;
            padding: 10px 12px;
        }

        .btn-link:hover {
            color: #111827;
        }

        /* ---------- FORMS ---------- */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }

        .form-input,
        .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            color: #1f2937;
            background: #ffffff;
            font-family: inherit;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        .form-input:focus,
        .form-select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .form-hint {
            font-size: 12px;
            color: #6b7280;
            font-weight: normal;
        }

        /* ---------- TABLE ---------- */
        .table-wrap {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            padding: 12px 16px;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        td {
            padding: 14px 16px;
            font-size: 14px;
            color: #374151;
            border-top: 1px solid #f3f4f6;
            word-break: break-word;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        .link-short {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        .link-short:hover {
            text-decoration: underline;
        }

        .empty-state {
            padding: 60px 20px;
            text-align: center;
        }

        .empty-state .icon {
            font-size: 42px;
            margin-bottom: 8px;
        }

        .empty-state .text {
            color: #6b7280;
            font-size: 14px;
        }

        /* ---------- LOGIN PAGE ---------- */
        .login-wrap {
            max-width: 420px;
            margin: 60px auto 0;
        }

        .login-title {
            font-size: 22px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 4px;
        }

        .login-sub {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 24px;
        }

        .credentials-box {
            margin-top: 24px;
            padding: 14px;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 13px;
            color: #4b5563;
        }

        .credentials-box .title {
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        /* ---------- WARNING BOX ---------- */
        .warning-box {
            margin-top: 20px;
            padding: 12px 14px;
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 8px;
            font-size: 13px;
            color: #92400e;
        }

        /* ---------- INVITE PAGE GRID ---------- */
        .invite-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            align-items: start;
        }

        .invite-list {
            min-width: 0;
        }

        .invite-form {
            position: sticky;
            top: 20px;
        }

        /* ---------- SCROLL AREA (250px max, hidden scrollbar) ---------- */
        .scroll-area {
            max-height: 250px;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            padding-right: 4px;
        }

        .scroll-area::-webkit-scrollbar {
            display: none;
        }

        /* ---------- COMPANY BLOCK ---------- */
        .company-block {
            margin-bottom: 16px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
        }

        .company-block:last-child {
            margin-bottom: 0;
        }

        .company-header {
            padding: 12px 16px;
            background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
        }

        .company-name {
            font-weight: 600;
            color: #111827;
            font-size: 15px;
        }

        .company-count {
            font-size: 12px;
            color: #6b7280;
            margin-top: 2px;
        }

        /* ---------- INNER TABLE ---------- */
        .inner-table {
            width: 100%;
            border-collapse: collapse;
        }

        .inner-table thead {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
        }

        .inner-table th {
            padding: 10px 14px;
            text-align: left;
            font-size: 11px;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .inner-table td {
            padding: 12px 14px;
            font-size: 14px;
            color: #374151;
            border-top: 1px solid #f3f4f6;
        }

        .inner-table tbody tr:hover {
            background: #f9fafb;
        }

        /* ---------- ROLE BADGE ---------- */
        .role-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        .role-superadmin {
            background: #fef3c7;
            color: #92400e;
        }

        .role-admin {
            background: #dbeafe;
            color: #1e40af;
        }

        .role-member {
            background: #dcfce7;
            color: #166534;
        }

        /* ---------- RESPONSIVE ---------- */
        @media (max-width: 900px) {
            .invite-grid {
                grid-template-columns: 1fr;
            }

            .invite-form {
                position: static;
            }
        }

        @media (max-width: 640px) {
            .navbar-inner {
                padding: 0 14px;
            }

            .nav-links {
                display: none;
            }

            .user-info {
                display: none;
            }

            .container {
                padding: 20px 14px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            th,
            td {
                padding: 10px;
                font-size: 13px;
            }
        }
    </style>
</head>

<body>

    @auth
        <nav class="navbar">
            <div class="navbar-inner">

                <div class="nav-left">
                    <a href="/short-urls" class="brand"> URL Shortener</a>

                    <div class="nav-links">
                        <a href="/dashboard"
                           class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                           Home
                        </a>
                        <a href="/short-urls"
                           class="{{ request()->is('short-urls*') ? 'active' : '' }}">
                            Short URLs
                        </a>
                        <a href="/invite"
                           class="{{ request()->is('invite*') ? 'active' : '' }}">
                            Invite User
                        </a>
                    </div>
                </div>

                <div class="nav-right">
                    <div class="user-info">
                        <div class="user-name">{{ auth()->user()->name }}</div>
                        <div class="user-role">{{ auth()->user()->role }}</div>
                    </div>

                    <form method="POST" action="/logout" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn-logout">Logout</button>
                    </form>
                </div>

            </div>
        </nav>
    @endauth

    <main class="container">

        {{-- Success --}}
        @if(session('success'))
            <div class="alert alert-success">
                <span>✅</span>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Error --}}
        @if(session('error'))
            <div class="alert alert-error">
                <span>❌</span>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
            <div class="alert alert-error">
                <div>
                    <div style="font-weight:600; margin-bottom:4px;">Please fix the following:</div>
                    <ul>
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')

    </main>

</body>

</html>
