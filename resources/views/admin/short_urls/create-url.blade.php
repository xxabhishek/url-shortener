@extends('layout')

@section('content')

<div class="card card-narrow">
    <div class="page-header">
        <div>
            <h1 class="page-title">Create Short URL</h1>
            <p class="page-subtitle">Paste a long URL and get a short link instantly</p>
        </div>
    </div>

    <form method="POST" action="/short-urls">
        @csrf

        <div class="form-group">
            <label class="form-label">Original URL</label>
            <input type="url" name="original_url" class="form-input"
                   placeholder="https://example.com/very/long/link"
                   value="{{ old('original_url') }}"
                   required autofocus>
        </div>

        <div style="display:flex; align-items:center; gap:8px;">
            <button type="submit" class="btn btn-primary">Create</button>
            <a href="/short-urls" class="btn btn-link">Cancel</a>
        </div>
    </form>
</div>

@endsection
