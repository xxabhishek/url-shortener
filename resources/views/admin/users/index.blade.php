@extends('layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Users</h1>
        <p class="page-subtitle">
            @if(auth()->user()->role === 'SuperAdmin')
                All users across every company
            @else
                Users in your company
            @endif
        </p>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-primary">+ Create New</a>
</div>

<div class="table-wrap">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                @if(auth()->user()->role === 'SuperAdmin')
                    <th>Company</th>
                @endif
                <th style="text-align:right;">Actions</th>
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
                    @if(auth()->user()->role === 'SuperAdmin')
                        <td>{{ $user->company->name ?? '-' }}</td>
                    @endif
                    <td style="text-align:right;">
                        <div style="display:inline-flex; gap:6px;">
                            <a href="{{ route('users.edit', $user) }}"
                               class="btn btn-secondary" style="padding:6px 12px; font-size:13px;">
                                Edit
                            </a>

                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('users.destroy', $user) }}"
                                      style="display:inline;"
                                      onsubmit="return confirm('Delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-secondary"
                                            style="padding:6px 12px; font-size:13px; color:#dc2626; border-color:#fecaca;">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ auth()->user()->role === 'SuperAdmin' ? 5 : 4 }}">
                        <div class="empty-state">
                            <div class="icon">👤</div>
                            <div class="text">No users yet.</div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
