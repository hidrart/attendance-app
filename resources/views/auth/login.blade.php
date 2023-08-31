@extends('layouts.auth')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="bg-gray rounded-4 p-4">
                <h1 class="fw-bolder text-center text-tertiary mb-4">
                    {{ __('Login') }}
                </h1>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="text-white fw-medium mb-1">{{ __('Email Address') }}</label>
                        <input type="email" class="phonska-form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="Your Email" name="email" value="{{ old('email') }}" required
                            autocomplete="email" autofocus>
                        <div class="invalid-feedback">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="text-white fw-medium mb-1">{{ __('Password') }}</label>
                        <input type="password" class="phonska-form-control @error('password') is-invalid @enderror"
                            id="password" placeholder="Your Password" name="password" required
                            autocomplete="current-password">
                        <div class="invalid-feedback">
                            @error('password')
                                {{ $message }}
                            @enderror
                        </div>
                        <p class="text-white text-end mt-2">
                            <a href="{{ route('password.request') }}" class="text-decoration-none text-white">
                                {{ __('Lupa Password?') }}
                            </a>
                        </p>
                    </div>

                    <button type="submit" class="btn btn-phonska w-100 fw-bold mb-2">
                        {{ __('Login') }}
                    </button>

                    <p class="text-white text-center">
                        {{ __('Belum punya akun?') }}
                        <a href="{{ route('register') }}" class="text-decoration-none text-white fw-bold">
                            {{ __('Buat Akun') }}
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
