@extends('layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Short URLs</h1>
        <p class="page-subtitle">
            @if(auth()->user()->role === 'SuperAdmin')
                All short URLs across every company
            @elseif(auth()->user()->role === 'Admin')
                All short URLs in your company
            @else
                Short URLs you created
            @endif
        </p>
    </div>

    @if(auth()->user()->role !== 'SuperAdmin')
        <a href="/short-urls/create" class="btn btn-primary">+ Create New</a>
    @endif
</div>

<div class="card">
    <div class="scroll-area">
        <table class="inner-table">
            <thead>
                <tr>
                    <th>Short Link</th>
                    <th>Original URL</th>
                    @if(auth()->user()->role !== 'Member')
                        <th>Created By</th>
                    @endif
                    @if(auth()->user()->role === 'SuperAdmin')
                        <th>Company</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($urls as $u)
                    <tr>
                        <td>
                            <a href="/{{ $u->short_code }}" target="_blank" class="link-short">
                                {{ url('/') }}/{{ $u->short_code }}
                            </a>
                        </td>
                        <td>{{ $u->original_url }}</td>
                        @if(auth()->user()->role !== 'Member')
                            <td>{{ $u->user->name ?? '-' }}</td>
                        @endif
                        @if(auth()->user()->role === 'SuperAdmin')
                            <td>{{ $u->company->name ?? '-' }}</td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ auth()->user()->role === 'SuperAdmin' ? 4 : (auth()->user()->role === 'Admin' ? 3 : 2) }}">
                            <div class="empty-state">
                                <div class="icon">📭</div>
                                <div class="text">No short URLs yet.</div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
