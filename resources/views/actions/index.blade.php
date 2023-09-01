@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="fw-bold text-primary mb-3">{{ $work->registration . ' Actions' }}</h3>
        @if (session('success'))
            <div class="text-primary fw-bold" role="alert">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="text-danger fw-bold" role="alert">
                {{ session('error') }}
            </div>
        @elseif($errors->any())
            <div class="text-danger fw-bold" role="alert">
                {{ $errors->first() }}
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
                                <a class="dropdown-item" href="{{ route('works.actions.index', $work->id) }}">
                                    Semua
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('works.actions.index', ['work' => $work->id, 'status' => 'pending']) }}">
                                    Pending
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('works.actions.index', ['work' => $work->id, 'status' => 'ongoing']) }}">
                                    On Going
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('works.actions.index', ['work' => $work->id, 'status' => 'completed']) }}">
                                    Completed
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="row align-items-center mt-3">
                <span class="fs-4 fw-bold text-primary col-12 col-lg-6 mb-2 mb-lg-0">Create Action</span>
                <div class="col-12 col-lg-6">
                    <button class="btn btn-muted w-100 d-flex" type="button" data-bs-toggle="modal"
                        data-bs-target="#createModal">
                        {{ __('Add Action') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{ $dataTable->table() }}

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <form class="modal-content bg-tertiary" method="POST" enctype="multipart/form-data"
                action="{{ route('actions.change') }}">
                @csrf
                <input type="hidden" name="id" id="id">

                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">
                        {{ __('Edit Action') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="photo" class="col-3 col-form-label">Photo</label>
                        <div class="col-9">
                            <img src="#" alt="photo" class="img-phonska mb-3" id="photoPreview">
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                                name="photo" value="{{ old('photo') }}" aria-describedby="photoFeedback">
                            <div id="photoFeedback" class="invalid-feedback">
                                @error('photo')
                                    {{ $message }}
                                @enderror
                            </div>

                            <script type="text/javascript"></script>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="plan" class="col-3 col-form-label">Plan</label>
                        <div class="col-9">
                            <input type="text" class="form-control @error('plan') is-invalid @enderror" id="plan"
                                name="plan" value="{{ old('plan') }}" aria-describedby="planFeedback">
                            <div id="planFeedback" class="invalid-feedback">
                                @error('plan')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="analysis" class="col-3 col-form-label">Analysis</label>
                        <div class="col-9">
                            <textarea class="form-control @error('analysis') is-invalid @enderror" id="analysis" name="analysis"
                                value="{{ old('analysis') }}" aria-describedby="analysisFeedback" rows="3"></textarea>
                            <div id="analysisFeedback" class="invalid-feedback">
                                @error('analysis')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="recommendation" class="col-3 col-form-label">Recommendation</label>
                        <div class="col-9">
                            <input type="text" class="form-control @error('recommendation') is-invalid @enderror"
                                id="recommendation" name="recommendation" value="{{ old('recommendation') }}"
                                aria-describedby="recommendationFeedback">
                            <div id="recommendationFeedback" class="invalid-feedback">
                                @error('recommendation')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="row">
                                <label for="status" class="col-6 col-form-label">Status</label>
                                <div class="col-6">
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" aria-describedby="statusFeedback">
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>On
                                            Going
                                        </option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                            Completed
                                        </option>
                                    </select>
                                    <div id="statusFeedback" class="invalid-feedback">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Edit</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <form class="modal-content bg-tertiary" method="POST" enctype="multipart/form-data"
                action="{{ route('works.actions.store', $work->id) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">
                        {{ __('Create Action') }}
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="photo" class="col-3 col-form-label">Photo</label>
                        <div class="col-9">
                            <img src="#" alt="photo" class="img-phonska mb-3" id="photoPreview">
                            <input type="file" class="form-control @error('photo') is-invalid @enderror"
                                id="photo" name="photo" value="{{ old('photo') }}"
                                aria-describedby="photoFeedback">
                            <div id="photoFeedback" class="invalid-feedback">
                                @error('photo')
                                    {{ $message }}
                                @enderror
                            </div>

                            <script type="text/javascript">
                                const photo = document.getElementById('photo');
                                const preview = document.getElementById('photoPreview');

                                photo.addEventListener('change', function() {
                                    const file = this.files[0];

                                    if (file) {
                                        const reader = new FileReader();
                                        reader.addEventListener('load', function() {
                                            preview.setAttribute('src', this.result);
                                        });
                                        reader.readAsDataURL(file);
                                    } else {
                                        preview.setAttribute('src', '#');
                                    }
                                });
                            </script>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="plan" class="col-3 col-form-label">Plan</label>
                        <div class="col-9">
                            <input type="text" class="form-control @error('plan') is-invalid @enderror" id="plan"
                                name="plan" value="{{ old('plan') }}" aria-describedby="planFeedback">
                            <div id="planFeedback" class="invalid-feedback">
                                @error('plan')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="analysis" class="col-3 col-form-label">Analysis</label>
                        <div class="col-9">
                            <textarea class="form-control @error('analysis') is-invalid @enderror" id="analysis" name="analysis"
                                value="{{ old('analysis') }}" aria-describedby="analysisFeedback" rows="3"></textarea>
                            <div id="analysisFeedback" class="invalid-feedback">
                                @error('analysis')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="recommendation" class="col-3 col-form-label">Recommendation</label>
                        <div class="col-9">
                            <input type="text" class="form-control @error('recommendation') is-invalid @enderror"
                                id="recommendation" name="recommendation" value="{{ old('recommendation') }}"
                                aria-describedby="recommendationFeedback">
                            <div id="recommendationFeedback" class="invalid-feedback">
                                @error('recommendation')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <div class="row">
                                <label for="status" class="col-6 col-form-label">Status</label>
                                <div class="col-6">
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" aria-describedby="statusFeedback">
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>On
                                            Going
                                        </option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                            Completed
                                        </option>
                                    </select>
                                    <div id="statusFeedback" class="invalid-feedback">
                                        @error('status')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const editModal = document.getElementById('editModal');
        const createModal = document.getElementById('createModal');

        editModal && editModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const action = button.getAttribute('data-bs-id');

            // get variables
            const id = editModal.querySelector('#id');
            const photo = editModal.querySelector('#photo');
            const preview = editModal.querySelector('#photoPreview');
            const plan = editModal.querySelector('#plan');
            const analysis = editModal.querySelector('#analysis');
            const recommendation = editModal.querySelector('#recommendation');
            const status = editModal.querySelector('#status');

            // set initial
            id.value = '';
            photo.value = '';
            plan.value = '';
            analysis.value = '';
            recommendation.value = '';
            status.value = 'pending';
            preview.setAttribute('src', '#');

            // listen to photo change
            photo.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.addEventListener('load', function() {
                        preview.setAttribute('src', this.result);
                    });
                    reader.readAsDataURL(file);
                } else {
                    preview.setAttribute('src', '#');
                }
            });

            // fetch data
            fetch(`/api/actions/${action}`)
                .then(response => response.json())
                .then(function(data) {
                    id.value = data.id;
                    photo.value = data.photo;
                    plan.value = data.plan;
                    analysis.value = data.analysis;
                    recommendation.value = data.recommendation;
                    status.value = data.status;
                    preview.setAttribute('src', data.photo);
                }).catch(function(error) {
                    console.log(error);
                });
        });

        createModal.addEventListener('show.bs.modal', function(event) {
            const photo = createModal.querySelector('#photo');
            const preview = createModal.querySelector('#photoPreview');

            photo.setAttribute('src', '#');
            preview.setAttribute('src', '#');

            photo.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.addEventListener('load', function() {
                        preview.setAttribute('src', this.result);
                    });
                    reader.readAsDataURL(file);
                } else {
                    preview.setAttribute('src', '#');
                }
            });
        });

        [editModal, createModal].forEach((modal) => {
            modal && modal.addEventListener('hidden.bs.modal', function(event) {
                const photo = modal.querySelector('#photo');
                const preview = modal.querySelector('#photoPreview');
                const plan = modal.querySelector('#plan');
                const analysis = modal.querySelector('#analysis');
                const recommendation = modal.querySelector('#recommendation');
                const status = modal.querySelector('#status');

                photo.setAttribute('src', '#');
                preview.setAttribute('src', '#');
                plan.value = '';
                analysis.value = '';
                recommendation.value = '';
                status.value = 'pending';
            });
        });
    </script>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
