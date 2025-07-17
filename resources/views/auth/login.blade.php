@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow border-0 w-100" style="max-width: 420px;">
        <div class="card-body p-5">

            {{-- Logo Kampus --}}
            <div class="text-center mb-4">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Politeknik" width="100" class="mb-2">
                <h5 class="fw-bold text-primary">Sistem KRS Online</h5>
                <small class="text-muted">Politeknik Indonesia Banjarmasin</small>
            </div>

            {{-- Error --}}
            @if ($errors->any())
                <div class="alert alert-danger text-center">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- Form Login --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Username (NIM/NIDN)</label>
                    <input type="text" name="username" id="username"
                           class="form-control" placeholder="Masukkan username" required autofocus>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password"
                           class="form-control" placeholder="Masukkan password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>

        </div>
    </div>
</div>
@endsection
