@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-5">
        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#presenceModal"
            @if ($attendance->checkin && $attendance->checkout) disabled @endif>
            <i class="bi bi-calendar-event me-2"></i>
            {{ __('Absen') }}
        </button>
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

    <h3 class="text-primary fw-bold mb-3">{{ __('List Absensi') }}</h3>

    <div class="row">
        <div class="col-12 col-lg-6 mb-4 mb-lg-0">
            <div class="bg-table border border-2 border-border">
                <h4 class="text-center text-primary fw-bold py-4 border-bottom border-2 border-border mb-3">
                    {{ __('Cek In') }}</h4>
                <div class="row p-4">
                    <div class="col-12 mb-4">
                        <img src="{{ $attendance->checkin?->photo }}" class="img-phonska" alt="checkin photo">
                    </div>
                    <div class="col-12">
                        <p class="fw-bold"> Tanggal :
                            {{ $attendance->checkin?->created_at->timezone('Asia/Jakarta')->isoFormat('dddd, DD MMMM YYYY') }}
                        </p>
                        <p class="fw-bold"> Jam :
                            {{ $attendance->checkin?->created_at->timezone('Asia/Jakarta')->isoFormat('HH:mm:ss') }}
                        </p>
                        <p class="fw-bold"> Lokasi :
                            {{ sprintf('%s, %s', $attendance->checkin?->latitude, $attendance->checkin?->longitude) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="bg-table border border-2 border-border">
                <h4 class="text-center text-primary fw-bold py-4 border-bottom border-2 border-border mb-3">
                    {{ __('Cek Out') }}</h4>
                <div class="row p-4">
                    <div class="col-12 mb-4">
                        <img src="{{ $attendance->checkout?->photo }}" class="img-phonska" alt="checkout photo">
                    </div>
                    <div class="col-12">
                        <p class="fw-bold"> Tanggal :
                            {{ $attendance->checkout?->created_at->timezone('Asia/Jakarta')->isoFormat('dddd, DD MMMM YYYY') }}
                        </p>
                        <p class="fw-bold"> Jam :
                            {{ $attendance->checkout?->created_at->timezone('Asia/Jakarta')->isoFormat('HH:mm:ss') }}
                        </p>
                        <p class="fw-bold"> Lokasi :
                            {{ sprintf('%s, %s', $attendance->checkout?->latitude, $attendance->checkout?->longitude) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="presenceModal" tabindex="-1" aria-labelledby="presenceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <form method="POST" action="{{ route($attendance->checkin ? 'checkout' : 'checkin') }}"
                class="modal-content bg-tertiary">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="presenceModalLabel">
                        {{ $attendance->checkin ? 'Cek Out' : 'Cek In' }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <canvas id="canvas" class="d-none" width="720" height="540"></canvas>
                    <div class="row">
                        <div class="col-6">
                            <video id="video" class="img-phonska w-100" autoplay></video>
                            <img id="output" class="img-phonska d-none" />
                        </div>
                        <div class="col-6">
                            <div id="map" class="img-phonska"></div>
                        </div>
                    </div>

                    <input type="hidden" name="photo" id="photo" />
                    <input type="hidden" name="latitude" id="latitude" />
                    <input type="hidden" name="longitude" id="longitude" />
                    <input type="hidden" name="accuracy" id="accuracy" />

                    <div class="mt-3 d-flex justify-content-center gap-2">
                        <button type="button" class="btn btn-secondary" id="capture">Capture</button>
                        <button type="button" class="btn btn-light" id="reset">Reset</button>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="submit">Save changes</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=myMap"></script>
    @endpush

    <script type="text/javascript" defer>
        // video
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const context = canvas.getContext('2d');
        const output = document.getElementById('output');
        const photo = document.getElementById('photo');
        const submit = document.getElementById('submit');
        const modal = document.getElementById('presenceModal');
        let media = null;

        // get current location
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    if (latitude != position.coords.latitude && longitude != position.coords.longitude) {
                        document.getElementById('latitude').value = position.coords.latitude;
                        document.getElementById('longitude').value = position.coords.longitude;
                        document.getElementById('accuracy').value = position.coords.accuracy;
                        initMap(position.coords.latitude, position.coords.longitude);
                    }
                },
                () => {}, {
                    timeout: 5000,
                    maximumAge: 10000,
                    enableHighAccuracy: true
                });
        } else {
            alert("Geolocation API is not supported in your browser.");
        }

        // initially hide the video and output element
        document.addEventListener('DOMContentLoaded', function() {
            submit.disabled = true;
            photo.value = '';
            output.src = '';
        });


        // show the camera on nodal show event
        document.addEventListener('show.bs.modal', function() {
            navigator.mediaDevices.getUserMedia && navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    media = stream;
                    video.srcObject = stream;
                })
                .catch(function(error) {
                    console.log("Something went wrong!");
                });
        });

        // hide the camera on nodal hide event
        document.addEventListener('hide.bs.modal', function() {
            media && media.getTracks()[0].stop();
        });

        // capture photo on button click
        document.getElementById('capture').addEventListener('click', function() {
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            photo.value = canvas.toDataURL();
            output.src = photo.value;

            video.pause();
            video.classList.add('d-none');
            output.classList.remove('d-none');
            submit.disabled = false;
        });

        // reset the camera on button click
        document.getElementById('reset').addEventListener('click', function() {
            context.clearRect(0, 0, canvas.width, canvas.height);
            photo.value = '';
            output.src = '';

            video.play();
            video.classList.remove('d-none');
            output.classList.add('d-none');
            submit.disabled = true;
        });

        // function to display map
        async function initMap(latitude, longitude) {
            const {
                Map
            } = await google.maps.importLibrary("maps");
            const map = new Map(document.getElementById("map"), {
                center: {
                    lat: latitude,
                    lng: longitude
                },
                zoom: 15,
            });
            const marker = new google.maps.Marker({
                position: {
                    lat: latitude,
                    lng: longitude
                },
                map: map,
            });
        }
    </script>
@endsection
