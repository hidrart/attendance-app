@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="fw-bold text-primary mb-3">{{ __('Logsheet Data') }}</h3>
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
                <span class="fs-4 fw-bold text-primary col-12 col-lg-6 mb-2 mb-lg-0">{{ __('Status') }}</span>
                <div class="col-12 col-lg-6">
                    <div class="dropdown">
                        <button
                            class="btn btn-muted dropdown-toggle w-100 d-flex align-items-center justify-content-between"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilih Status
                        </button>
                        <ul class="dropdown-menu w-100">
                            <li>
                                <a class="dropdown-item" href="{{ route('logsheet') }}">
                                    Semua
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logsheet', ['status' => 'pending']) }}">
                                    Pending
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logsheet', ['status' => 'ongoing']) }}">
                                    On Going
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logsheet', ['status' => 'completed']) }}">
                                    Completed
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <canvas id="chart" class="mt-3"></canvas>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const context = document.getElementById('chart').getContext('2d');

        const chart = new Chart(context, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: [{
                    label: '{{ $title }}',
                    backgroundColor: '#4050e7',
                    borderColor: '#4050e7',
                    data: @json($data),
                }]
            },
            options: {
                responsive: true,
                barRoundness: 1,
                title: {
                    display: true,
                    text: '{{ $title }}'
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            suggestedMax: 40 + 20,
                            padding: 10,
                        },
                        gridLines: {
                            drawBorder: false,
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            drawBorder: false
                        }
                    }]
                }
            }
        });
    </script>
@endpush
