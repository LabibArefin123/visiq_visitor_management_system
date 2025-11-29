@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0">
                    <div class="row g-0">
                        {{-- Left side (icon and title) --}}
                        <!-- Left side (icon and title) -->
                        <div class="col-md-6 bg-light d-flex flex-column justify-content-center p-5 text-start">
                            <!-- Center heading and image horizontally -->
                            <div class="text-center mb-4">
                                <h2 class="fw-bold text-primary mb-3">Welcome to VisiQ</h2>
                                <img src="{{ asset('images/visiq.png') }}" alt="VisiQ Logo"
                                    style="max-width: 180px; height: auto;">
                            </div>

                            <!-- Left aligned paragraphs -->
                            <p class="text-secondary fs-5">
                                VisiQ is a smart visitor management system built to enhance your organization's front-desk
                                experience.
                            </p>

                            <p class="text-muted fs-6">
                                🚀 Effortless Check-ins<br>
                                🔒 Secure Access Control<br>
                                📊 Real-Time Visitor Logs
                            </p>

                            <p class="text-muted mt-3">
                                <b>Smart Check-in. Secure Access. Seamless Management.</b>
                            </p>
                        </div>

                        {{-- Right side (form) --}}
                        <div class="col-md-6 p-4">
                            <br>
                            <h3 class="text-center mb-4 text-primary fw-bold">Register for VisiQ Account</h3>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                {{-- Full Name --}}
                                <div class="form-floating mb-3">
                                    <input id="name" type="text"
                                        class="form-control rounded-3 @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autofocus>
                                    <label for="name">Full Name</label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Phone Number --}}
                                <div class="form-floating mb-3">
                                    <input id="phone_1" type="text"
                                        class="form-control rounded-3 @error('phone_1') is-invalid @enderror" name="phone_1"
                                        value="{{ old('phone_1') }}" required>
                                    <label for="phone_1">Phone Number</label>
                                    @error('phone_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="form-floating mb-3">
                                    <input id="email" type="email"
                                        class="form-control rounded-3 @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required>
                                    <label for="email">Email Address</label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Password --}}
                                <div class="form-floating mb-3">
                                    <input id="password" type="password"
                                        class="form-control rounded-3 @error('password') is-invalid @enderror"
                                        name="password" required>
                                    <label for="password">Password</label>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Confirm Password --}}
                                <div class="form-floating mb-4">
                                    <input id="password-confirm" type="password" class="form-control rounded-3"
                                        name="password_confirmation" required>
                                    <label for="password-confirm">Confirm Password</label>
                                </div>

                                {{-- Register Button --}}
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                                        <i class="fas fa-user-plus me-2"></i> Register
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Helpdesk --}}
                {{-- Helpdesk and Powered by --}}
                <div class="row justify-content-center mt-4 align-items-center">
                    <div class="col-md-6 text-center text-md-start">
                        <h5 class="mb-1">VisiQ Support</h5>
                        <p class="mb-1 d-inline-block me-3">
                            <a href="tel:09643111222" class="text-decoration-none">09643 111 222</a><br>
                            <a href="mailto:helpdesk@totalofftec.com"
                                class="text-decoration-none">helpdesk@totalofftec.com</a>
                        </p>
                     
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <h5 class="mb-0">
                            Developed by
                            <a href="https://totalofftec.com" target="_blank" class="text-decoration-none">TOTALOFFTEC</a>
                        </h5>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

{{-- Background --}}
<style>
    body {
        background-image: url('{{ asset('images/wallpaper.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
</style>
