@extends('layout')

@section('content')

<div class="card card-narrow">
    <div class="page-header">
        <div>
            <h1 class="page-title">Create User</h1>
            <p class="page-subtitle">
                @if(auth()->user()->role === 'SuperAdmin')
                    Create a new user in a new company
                @else
                    Add a new user to your company
                @endif
            </p>
        </div>
    </div>

    <form method="POST" action="{{ route('users.store') }}">
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
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-input"
                   placeholder="Minimum 8 characters" required>
        </div>

        <div class="form-group">
            <label class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-input"
                   placeholder="Re-enter password" required>
        </div>

        <div class="form-group">
            <label class="form-label">Role</label>
            <select name="role" class="form-select" required>
                <option value="">-- Select Role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role }}" {{ old('role') == $role ? 'selected' : '' }}>
                        {{ $role }}
                    </option>
                @endforeach
            </select>
        </div>

        @if(auth()->user()->role === 'SuperAdmin')
            <div class="form-group">
                <label class="form-label">Company Name</label>
                <input type="text" name="company_name" class="form-input"
                    value="{{ old('company_name') }}" required>
            </div>
        @endif

        <div style="display:flex; align-items:center; gap:8px;">
            <button type="submit" class="btn btn-primary">Create User</button>
            <a href="{{ route('users.index') }}" class="btn btn-link">Cancel</a>
        </div>
    </form>
</div>

@endsection
