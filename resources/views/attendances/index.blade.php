@extends('layouts.app')

@section('content')
    <div class="mt-5">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        {{ $dataTable->table() }}
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
