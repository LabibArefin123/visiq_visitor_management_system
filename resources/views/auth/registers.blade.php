<br>
<section class="content-header text-center" style="padding: 100px 0; background: url('{{ asset('images/vms.png') }}') no-repeat center center; background-size: cover; color: white;">
    <div class="container" data-aos="fade-up">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 rounded-4" style="background: rgba(255,255,255,0.85);">
                    <div class="row g-0">
                        <!-- Left Side -->
                        <div class="col-md-6 d-flex align-items-center justify-content-center p-4">
                            <div class="text-center">
                                <img src="{{ asset('vendor/adminlte/dist/img/SORKAR (2).png') }}" alt="VisiQ Logo"
                                    style="width: 120px; height: 120px;" class="mb-4">
                                <h2 class="fw-bold text-dark">Welcome to VisiQ</h2>
                                <p class="text-muted fw-semibold">Smart & Secure Visitor Management System</p>
                            </div>
                        </div>

                        <!-- Right Side -->
                        <div class="col-md-6 p-4">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="mb-4 text-start">
                                    <label for="login" class="form-label fw-semibold">Email or Username</label>
                                    <input id="login" type="text"
                                        class="form-control form-control-lg rounded-3 shadow-sm @error('login') is-invalid @enderror"
                                        name="login" value="{{ old('login') }}"
                                        placeholder="Enter your email or username" required autofocus>
                                    @error('login')
                                        <div class="invalid-feedback d-block mt-1"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="mb-4 text-start">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <input id="password" type="password"
                                        class="form-control form-control-lg rounded-3 shadow-sm @error('password') is-invalid @enderror"
                                        name="password" placeholder="Enter your password" required>
                                    @error('password')
                                        <div class="invalid-feedback d-block mt-1"><strong>{{ $message }}</strong></div>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" class="btn btn-success px-4 py-2 rounded-pill shadow-sm">
                                        Login
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="text-decoration-none text-primary fw-semibold" href="#" id="forgotPasswordLink">
                                            Forgot Password?
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div> <!-- end row -->
                </div> <!-- end card -->
            </div>
        </div>

        <!-- VisiQ Support -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-8 text-center">
                <h5 class="mb-1">VisiQ Support</h5>
                <p class="mb-1">
                    <a href="tel:09643111222" class="text-decoration-none">09643 111 222</a>
                </p>
                <p>
                    <a href="mailto:helpdesk@totalofftec.com" class="text-decoration-none">helpdesk@totalofftec.com</a>
                </p>
            </div>
        </div>

        <!-- Footer -->
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <h5 class="text-center">Powered by
                    <a href="https://totalofftec.com" target="_blank" class="text-decoration-none">TOTALOFFTEC</a>
                </h5>
            </div>
        </div>
    </div>
</section>
