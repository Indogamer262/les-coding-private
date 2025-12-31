@extends('layouts.guest')

@section('title', 'Login - Sistem Les Privat')

@section('content')
<div style="padding: 2rem;">
    <!-- Mock Form -->
    <form action="/login" method="POST">
        @csrf
        <div class="form-group">
            <label class="form-label" for="email">Email Address</label>
            <input type="email" id="email" name="email" class="form-control" placeholder="admin@example.com" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="password">Password</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required>
        </div>

        <div class="form-group">
            <label class="form-label">Masuk Sebagai (Simulasi)</label>
            <select name="role_simulation" class="form-control" onchange="this.form.action = '/' + this.value">
                <option value="login">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="student">Murid</option>
                <option value="teacher">Pengajar</option>
            </select>
            <p class="text-xs text-muted mt-2">
                *Pilih role untuk simulasi navigasi di prototype ini.
            </p>
        </div>

        <div class="flex items-center justify-between mb-4">
            <label class="flex items-center text-sm text-muted">
                <input type="checkbox" style="margin-right: 0.5rem;"> Remember me
            </label>
            <a href="#" class="text-sm text-primary hover:underline">Forgot password?</a>
        </div>

        <button type="submit" class="btn btn-primary w-full">
            Sign In
        </button>
    </form>
</div>
@endsection
