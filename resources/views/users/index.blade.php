@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="fw-bold text-primary mb-3">{{ __('Users Data') }}</h3>
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

    {{ $dataTable->table() }}
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
