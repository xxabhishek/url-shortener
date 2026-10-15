@extends('layout')

@section('content')

<div class="card card-narrow">
    <div class="page-header">
        <div>
            <h1 class="page-title">Edit User</h1>
            <p class="page-subtitle">Update user details</p>
        </div>
    </div>

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-input"
                   value="{{ old('name', $user->name) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-input"
                   value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label class="form-label">
                Password
                <span class="form-hint">(leave blank to keep current)</span>
            </label>
            <input type="password" name="password" class="form-input"
                   placeholder="New password (optional)">
        </div>

        <div class="form-group">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-input"
                   placeholder="Re-enter new password">
        </div>

        <div class="form-group">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
                @foreach($roles as $role)
                    <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                        {{ $role }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="display:flex; align-items:center; gap:8px;">
            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="{{ route('users.index') }}" class="btn btn-link">Cancel</a>
        </div>
    </form>
</div>

@endsection
