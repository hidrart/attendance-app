@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="fw-bold text-primary mb-3">{{ __('Data Absensi') }}</h3>
        @if (session('success'))
            <div class="text-primary fw-bold" role="alert">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="text-danger fw-bold" role="alert">
                {{ session('error') }}
            </div>
        @endif
    </div>


    <div class="row">
        <div class="col-12 col-lg-4 mb-3">
            <div class="row align-items-center">
                <span class="fs-4 fw-bold text-primary col-12 col-lg-6 mb-2 mb-lg-0">Role</span>
                <div class="col-12 col-lg-6">
                    <div class="dropdown">
                        <button
                            class="btn btn-muted dropdown-toggle w-100 d-flex align-items-center justify-content-between"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilih Role
                        </button>
                        <ul class="dropdown-menu w-100">
                            <li> <a class="dropdown-item" href="{{ route('attendances.index') }}">Semua</a></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('attendances.index', ['role' => 'admin']) }}">
                                    Admin
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('attendances.index', ['role' => 'organik']) }}">
                                    Organik
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('attendances.index', ['role' => 'tambahan']) }}">
                                    Tambahan
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{ $dataTable->table() }}
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
