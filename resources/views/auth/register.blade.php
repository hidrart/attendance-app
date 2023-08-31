@extends('layouts.auth')

@section('content')
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-5">
            <div class="bg-gray rounded-4 p-4">
                <h1 class="fw-bolder text-center text-tertiary mb-4">
                    {{ __('Daftar') }}
                </h1>


                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="text-white fw-medium mb-1">{{ __('Pilih Role') }}</label>
                        <select name="role" id="role" class="phonska-form-select @error('role') is-invalid @enderror"
                            required>
                            <option value="" selected disabled>Pilih Role</option>
                            <option value="organik">Organik</option>
                            <option value="bantuan">Bantuan</option>
                        </select>
                        <div class="invalid-feedback">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="text-white fw-medium mb-1">{{ __('Nama Lengkap') }}</label>
                        <input type="text" class="phonska-form-control @error('name') is-invalid @enderror"
                            id="name" placeholder="Your Name" name="name" value="{{ old('name') }}" required
                            autocomplete="name" autofocus>
                        <div class="invalid-feedback">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="text-white fw-medium mb-1">{{ __('Email') }}</label>
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
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="text-white fw-medium mb-1">{{ __('Nomor Telepon') }}</label>
                        <input type="text" class="phonska-form-control @error('phone') is-invalid @enderror"
                            id="phone" placeholder="Your Phone" name="phone" value="{{ old('phone') }}" required
                            autocomplete="phone" autofocus>
                        <div class="invalid-feedback">
                            @error('phone')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-phonska w-100 fw-bold mb-2">
                        {{ __('Daftar') }}
                    </button>

                    <p class="text-white text-center">
                        {{ __('Sudah punya akun?') }}
                        <a href="{{ route('login') }}" class="text-decoration-none text-white fw-bold">
                            {{ __('Login') }}
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
