{{-- {{ $status }} --}}
@php
    switch ($status) {
        case 'pending':
            $class = 'text-bg-light';
            break;
        case 'ongoing':
            $class = 'text-bg-secondary';
            break;
        default:
            $class = 'text-bg-warning';
            break;
    }
@endphp

<span class="badge {{ $class }}">{{ $status }}</span>
