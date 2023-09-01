@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="fw-bold text-primary mb-3">{{ __('Outstanding Work') }}</h3>
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
                <span class="fs-4 fw-bold text-primary col-12 col-lg-6 mb-2 mb-lg-0">PIC</span>
                <div class="col-12 col-lg-6">
                    <div class="dropdown">
                        <button
                            class="btn btn-muted dropdown-toggle w-100 d-flex align-items-center justify-content-between"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pilih PIC
                        </button>
                        <ul class="dropdown-menu w-100">
                            <li>
                                <a class="dropdown-item" href="{{ route('works.index') }}">Semua</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('works.index', ['pic' => 'Listrik']) }}">
                                    Listrik
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('works.index', ['pic' => 'Production']) }}">
                                    Production
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('works.index', ['pic' => 'Bengkel']) }}">
                                    Bengkel
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            @role('admin')
                <div class="row align-items-center mt-3">
                    <span class="fs-4 fw-bold text-primary col-12 col-lg-6 mb-2 mb-lg-0">Create Work</span>
                    <div class="col-12 col-lg-6">
                        <button class="btn btn-muted w-100 d-flex" type="button" data-bs-toggle="modal"
                            data-bs-target="#createModal">
                            {{ __('Add Work') }}
                        </button>
                    </div>
                </div>
            @endrole
        </div>
    </div>

    {{ $dataTable->table() }}

    @role('admin')
        <!-- Detail Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="false">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <form method="POST" action="{{ route('works.change') }}" class="modal-content bg-tertiary">
                    @csrf
                    <input type="hidden" name="id" id="id">

                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">
                            {{ __('Create Work') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="date" class="col-2 col-form-label">Tanggal</label>
                            <div class="col-10">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror"
                                    aria-describedby="date dateFeedback" name="date" value="{{ old('date') }}">
                                <div id="dateFeedback" class="invalid-feedback">
                                    @error('date')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="plant" class="col-2 col-form-label">Plant</label>
                            <div class="col-10">
                                <input id="plant" type="text" class="form-control @error('plant') is-invalid @enderror"
                                    aria-describedby="plant plantFeedback" name="plant" value="{{ old('plant') }}">
                                <div id="plantFeedback" class="invalid-feedback">
                                    @error('plant')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="registration" class="col-2 col-form-label">Registration</label>
                            <div class="col-10">
                                <input id="registration" type="text"
                                    class="form-control @error('registration') is-invalid @enderror"
                                    aria-describedby="registration registrationFeedback" name="registration"
                                    value="{{ old('registration') }}">
                                <div id="registrationFeedback" class="invalid-feedback">
                                    @error('registration')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="row">
                                    <label for="pic" class="col-4 col-form-label">PIC</label>
                                    <div class="col-8">
                                        <select class="form-select" id="pic" name="pic"
                                            aria-describedby="pic picFeedback">
                                            <option value="Listrik" @if (old('pic') == 'Listrik') selected @endif>
                                                Listrik
                                            </option>
                                            <option value="Production" @if (old('pic') == 'Production') selected @endif>
                                                Production
                                            </option>
                                            <option value="Bengkel" @if (old('pic') == 'Bengkel') selected @endif>
                                                Bengkel
                                            </option>
                                        </select>
                                        <div id="picFeedback" class="invalid-feedback">
                                            @error('pic')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <label for="frequency" class="col-4 col-form-label">Frequency</label>
                                    <div class="col-8">
                                        <select class="form-select" id="frequency" name="frequency"
                                            aria-describedby="frequency frequencyFeedback">
                                            <option value="Rutin" @if (old('frequency') == 'Rutin') selected @endif>
                                                Rutin
                                            </option>
                                            <option value="Tahunan" @if (old('frequency') == 'Tahunan') selected @endif>
                                                Tahunan
                                            </option>
                                        </select>
                                        <div id="frequencyFeedback" class="invalid-feedback">
                                            @error('frequency')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="classification" class="col-2 col-form-label">Classification</label>
                            <div class="col-10">
                                <input id="classification" type="text"
                                    class="form-control @error('classification') is-invalid @enderror"
                                    aria-describedby="classification classificationFeedback" name="classification"
                                    value="{{ old('classification') }}">
                                <div id="classificationFeedback" class="invalid-feedback">
                                    @error('classification')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="parameter" class="col-2 col-form-label">Parameter</label>
                            <div class="col-10">
                                <input id="parameter" type="text"
                                    class="form-control @error('parameter') is-invalid @enderror"
                                    aria-describedby="parameter parameterFeedback" name="parameter"
                                    value="{{ old('parameter') }}">
                                <div id="parameterFeedback" class="invalid-feedback">
                                    @error('parameter')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="row">
                                    <label for="wo" class="col-4 col-form-label">WO</label>
                                    <div class="col-8">
                                        <input id="wo" type="text"
                                            class="form-control @error('wo') is-invalid @enderror"
                                            aria-describedby="wo woFeedback" name="wo" value="{{ old('wo') }}">
                                        <div id="woFeedback" class="invalid-feedback">
                                            @error('wo')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <label for="jpp" class="col-4 col-form-label">JPP</label>
                                    <div class="col-8">
                                        <input id="jpp" type="text"
                                            class="form-control @error('jpp') is-invalid @enderror"
                                            aria-describedby="jpp jppFeedback" name="jpp" value="{{ old('jpp') }}">
                                        <div id="jppFeedback" class="invalid-feedback">
                                            @error('jpp')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="notification" class="col-2 col-form-label">Notification</label>
                            <div class="col-10">
                                <input id="notification" type="text"
                                    class="form-control @error('notification') is-invalid @enderror"
                                    aria-describedby="notification notificationFeedback" name="notification"
                                    value="{{ old('notification') }}">
                                <div id="notificationFeedback" class="invalid-feedback">
                                    @error('notification')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="equipment" class="col-2 col-form-label">Equipment</label>
                            <div class="col-10">
                                <input id="equipment" type="text"
                                    class="form-control @error('equipment') is-invalid @enderror"
                                    aria-describedby="equipment equipmentFeedback" name="equipment"
                                    value="{{ old('equipment') }}">
                                <div id="equipmentFeedback" class="invalid-feedback">
                                    @error('equipment')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <label for="value" class="col-4 col-form-label">Value</label>
                                    <div class="col-8">
                                        <input id="value" type="text"
                                            class="form-control @error('value') is-invalid @enderror"
                                            aria-describedby="value valueFeedback" name="value"
                                            value="{{ old('value') }}">
                                        <div id="valueFeedback" class="invalid-feedback">
                                            @error('value')
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

        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="false">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <form method="POST" action="{{ route('works.store') }}" class="modal-content bg-tertiary">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">
                            {{ __('Create Work') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <label for="date" class="col-2 col-form-label">Tanggal</label>
                            <div class="col-10">
                                <input id="date" type="date"
                                    class="form-control @error('date') is-invalid @enderror"
                                    aria-describedby="date dateFeedback" name="date" value="{{ old('date') }}">
                                <div id="dateFeedback" class="invalid-feedback">
                                    @error('date')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="plant" class="col-2 col-form-label">Plant</label>
                            <div class="col-10">
                                <input id="plant" type="text"
                                    class="form-control @error('plant') is-invalid @enderror"
                                    aria-describedby="plant plantFeedback" name="plant" value="{{ old('plant') }}">
                                <div id="plantFeedback" class="invalid-feedback">
                                    @error('plant')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="registration" class="col-2 col-form-label">Registration</label>
                            <div class="col-10">
                                <input id="registration" type="text"
                                    class="form-control @error('registration') is-invalid @enderror"
                                    aria-describedby="registration registrationFeedback" name="registration"
                                    value="{{ old('registration') }}">
                                <div id="registrationFeedback" class="invalid-feedback">
                                    @error('registration')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="row">
                                    <label for="pic" class="col-4 col-form-label">PIC</label>
                                    <div class="col-8">
                                        <select class="form-select" id="pic" name="pic"
                                            aria-describedby="pic picFeedback">
                                            <option value="Listrik" @if (old('pic') == 'Listrik') selected @endif>
                                                Listrik
                                            </option>
                                            <option value="Production" @if (old('pic') == 'Production') selected @endif>
                                                Production
                                            </option>
                                            <option value="Bengkel" @if (old('pic') == 'Bengkel') selected @endif>
                                                Bengkel
                                            </option>
                                        </select>
                                        <div id="picFeedback" class="invalid-feedback">
                                            @error('pic')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <label for="frequency" class="col-4 col-form-label">Frequency</label>
                                    <div class="col-8">
                                        <select class="form-select" id="frequency" name="frequency"
                                            aria-describedby="frequency frequencyFeedback">
                                            <option value="Rutin" @if (old('frequency') == 'Rutin') selected @endif>
                                                Rutin
                                            </option>
                                            <option value="Tahunan" @if (old('frequency') == 'Tahunan') selected @endif>
                                                Tahunan
                                            </option>
                                        </select>
                                        <div id="frequencyFeedback" class="invalid-feedback">
                                            @error('frequency')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="classification" class="col-2 col-form-label">Classification</label>
                            <div class="col-10">
                                <input id="classification" type="text"
                                    class="form-control @error('classification') is-invalid @enderror"
                                    aria-describedby="classification classificationFeedback" name="classification"
                                    value="{{ old('classification') }}">
                                <div id="classificationFeedback" class="invalid-feedback">
                                    @error('classification')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="parameter" class="col-2 col-form-label">Parameter</label>
                            <div class="col-10">
                                <input id="parameter" type="text"
                                    class="form-control @error('parameter') is-invalid @enderror"
                                    aria-describedby="parameter parameterFeedback" name="parameter"
                                    value="{{ old('parameter') }}">
                                <div id="parameterFeedback" class="invalid-feedback">
                                    @error('parameter')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <div class="row">
                                    <label for="wo" class="col-4 col-form-label">WO</label>
                                    <div class="col-8">
                                        <input id="wo" type="text"
                                            class="form-control @error('wo') is-invalid @enderror"
                                            aria-describedby="wo woFeedback" name="wo" value="{{ old('wo') }}">
                                        <div id="woFeedback" class="invalid-feedback">
                                            @error('wo')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="row">
                                    <label for="jpp" class="col-4 col-form-label">JPP</label>
                                    <div class="col-8">
                                        <input id="jpp" type="text"
                                            class="form-control @error('jpp') is-invalid @enderror"
                                            aria-describedby="jpp jppFeedback" name="jpp" value="{{ old('jpp') }}">
                                        <div id="jppFeedback" class="invalid-feedback">
                                            @error('jpp')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="notification" class="col-2 col-form-label">Notification</label>
                            <div class="col-10">
                                <input id="notification" type="text"
                                    class="form-control @error('notification') is-invalid @enderror"
                                    aria-describedby="notification notificationFeedback" name="notification"
                                    value="{{ old('notification') }}">
                                <div id="notificationFeedback" class="invalid-feedback">
                                    @error('notification')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="equipment" class="col-2 col-form-label">Equipment</label>
                            <div class="col-10">
                                <input id="equipment" type="text"
                                    class="form-control @error('equipment') is-invalid @enderror"
                                    aria-describedby="equipment equipmentFeedback" name="equipment"
                                    value="{{ old('equipment') }}">
                                <div id="equipmentFeedback" class="invalid-feedback">
                                    @error('equipment')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="row">
                                    <label for="value" class="col-4 col-form-label">Value</label>
                                    <div class="col-8">
                                        <input id="value" type="text"
                                            class="form-control @error('value') is-invalid @enderror"
                                            aria-describedby="value valueFeedback" name="value"
                                            value="{{ old('value') }}">
                                        <div id="valueFeedback" class="invalid-feedback">
                                            @error('value')
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

        <script type="text/javascript" defer>
            const editModal = document.getElementById('editModal');
            const createModal = document.getElementById('createModal');

            editModal && editModal.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                const work = button.getAttribute('data-bs-id');

                const id = editModal.querySelector('#id');
                const date = editModal.querySelector('#date');
                const plant = editModal.querySelector('#plant');
                const registration = editModal.querySelector('#registration');
                const pic = editModal.querySelector('#pic');
                const classification = editModal.querySelector('#classification');
                const parameter = editModal.querySelector('#parameter');
                const wo = editModal.querySelector('#wo');
                const jpp = editModal.querySelector('#jpp');
                const notification = editModal.querySelector('#notification');
                const equipment = editModal.querySelector('#equipment');
                const frequency = editModal.querySelector('#frequency');
                const value = editModal.querySelector('#value');

                id.value = '';
                date.value = '';
                plant.value = '';
                registration.value = '';
                pic.value = '';
                classification.value = '';
                parameter.value = '';
                wo.value = '';
                jpp.value = '';
                notification.value = '';
                equipment.value = '';
                frequency.value = '';
                value.value = '';

                fetch(`/api/works/${work}`)
                    .then(response => response.json())
                    .then(data => {
                        id.value = data.id;
                        plant.value = data.plant;
                        registration.value = data.registration;
                        pic.value = data.pic;
                        classification.value = data.classification;
                        parameter.value = data.parameter;
                        wo.value = data.wo;
                        jpp.value = data.jpp;
                        notification.value = data.notification;
                        equipment.value = data.equipment;
                        frequency.value = data.frequency;
                        value.value = data.value;
                    }).catch((error) => {
                        console.error('Error:', error);
                    });
            })
        </script>
    @endrole
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
