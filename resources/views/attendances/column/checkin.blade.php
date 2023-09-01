@if ($checkin)
    <img src="{{ $checkin->photo }}" class="img-phonska mb-1" alt="checkin photo">
    <span class="fw-medium"> {{ $checkin->created_at->timezone('Asia/Jakarta')->isoFormat('HH:mm:ss') }} </span>
    {{-- <span> {{ sprintf('%s, %s', $checkin->latitude, $checkin->longitude) }}</span> --}}
@endif
