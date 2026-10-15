@extends('layout')

@section('content')

<div class="invite-grid">

    {{-- ==================== LEFT: CREATE FORM ==================== --}}
    <div class="invite-form">

        <div class="card">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Invite User</h1>
                    <p class="page-subtitle">
                        @if(auth()->user()->role === 'SuperAdmin')
                            Create a new Admin in a new company
                        @else
                            Add a new Admin or Member to your company
                        @endif
                    </p>
                </div>
            </div>

            <form method="POST" action="/invite">
                @csrf

                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-input"
                           value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-input"
                           value="{{ old('email') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select" required>
                        <option value="Admin">Admin</option>
                        <option value="Member">Member</option>
                    </select>
                </div>

                @if(auth()->user()->role === 'SuperAdmin')
                    <div class="form-group">
                        <label class="form-label">
                            Company Name
                            <span class="form-hint">(new company will be created)</span>
                        </label>
                        <input type="text" name="company_name" class="form-input"
                               value="{{ old('company_name') }}" required>
                    </div>
                @endif

                <button type="submit" class="btn btn-primary" style="width:100%;">
                    Create User
                </button>
            </form>

            <div class="warning-box">
                ⚠️ New user's default password will be <strong>password</strong>.
            </div>
        </div>

    </div>

    {{-- ==================== RIGHT: USERS LIST ==================== --}}
    <div class="invite-list">

        @if(auth()->user()->role === 'SuperAdmin')
            <div class="card">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">All Users by Company</h1>
                        <p class="page-subtitle">Users grouped by their company</p>
                    </div>
                </div>

                <div class="scroll-area">
                    @forelse($companies as $company)
                        <div class="company-block">
                            <div class="company-header">
                                <div class="company-name">🏢 {{ $company->name }}</div>
                                <div class="company-count">
                                    {{ $company->users->count() }}
                                    {{ Str::plural('user', $company->users->count()) }}
                                </div>
                            </div>

                            <table class="inner-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($company->users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <span class="role-badge role-{{ strtolower($user->role) }}">
                                                    {{ $user->role }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" style="text-align:center; color:#6b7280;">
                                                No users in this company yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @empty
                        <div class="empty-state">
                            <div class="icon">🏢</div>
                            <div class="text">No companies yet.</div>
                        </div>
                    @endforelse
                </div>
            </div>

        @else
            <div class="card">
                <div class="page-header">
                    <div>
                        <h1 class="page-title">
                            Users in {{ auth()->user()->company->name ?? 'Your Company' }}
                        </h1>
                        <p class="page-subtitle">All users in your company</p>
                    </div>
                </div>

                <div class="scroll-area">
                    <table class="inner-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="role-badge role-{{ strtolower($user->role) }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="empty-state">
                                            <div class="icon">👥</div>
                                            <div class="text">No users yet.</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @endif

    </div>

</div>

@endsection
