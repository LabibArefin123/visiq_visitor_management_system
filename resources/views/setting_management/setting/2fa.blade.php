@extends('adminlte::page')

@section('title', 'Two-Factor Authentication')

@section('content_header')
    <h3>Two-Factor Authentication</h3>
@stop

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow rounded-4 border-0">

                <div class="card-body">
                    <p class="mb-3">Toggle 2FA for your account.</p>

                    {{-- Success/Error Messages --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    {{-- 2FA Toggle Form --}}
                    <form action="{{ route('settings.toggle2fa') }}" method="POST" class="mb-3">
                        @csrf
                        @php
                            // 2FA is verified if code is null
                            $twoFactorVerified = is_null($user->two_factor_code);
                        @endphp

                        @if ($user->two_factor_enabled)
                            <button type="submit" class="btn btn-danger btn-block"
                                @if (!$twoFactorVerified) disabled @endif>
                                Disable Two-Factor Authentication
                            </button>
                        @else
                            <button type="submit" class="btn btn-success btn-block">
                                Enable Two-Factor Authentication
                            </button>
                        @endif
                    </form>

                    {{-- Verify & Resend only if 2FA is enabled and not yet verified --}}
                    @if ($user->two_factor_enabled && !is_null($user->two_factor_code))
                        {{-- Verify Code --}}
                        <form action="{{ route('settings.2fa.verify') }}" method="POST" class="mb-2">
                            @csrf
                            <div class="input-group mb-2">
                                <input type="text" name="code" class="form-control" placeholder="Enter 2FA code"
                                    required>
                                <button type="submit" class="btn btn-primary">Verify</button>
                            </div>
                        </form>

                        {{-- Resend Code --}}
                        <form action="{{ route('settings.2fa.resend') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-info btn-block">Resend Code</button>
                        </form>
                    @endif

                    {{-- Admin View: See 2FA Code & Expiry --}}
                    @role('admin')
                        <div class="mt-3">
                            <p><strong>Two-Factor Code:</strong> {{ $user->two_factor_code ?? 'N/A' }}</p>
                            <p><strong>Expires At:</strong>
                                {{ $user->two_factor_expires_at ? \Carbon\Carbon::parse($user->two_factor_expires_at)->format('d F Y H:i') : 'N/A' }}
                            </p>
                        </div>
                    @endrole

                </div>

            </div>
        </div>
    </div>
@stop
