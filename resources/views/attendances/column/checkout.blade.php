@if ($checkout)
    <img src="{{ $checkout->photo }}" class="img-phonska mb-1" alt="checkout photo">
    <span class="fw-medium"> {{ $checkout->created_at->timezone('Asia/Jakarta')->isoFormat('HH:mm:ss') }} </span>
    {{-- <span> {{ sprintf('%s, %s', $checkout->latitude, $checkout->longitude) }}</span> --}}
@endif
