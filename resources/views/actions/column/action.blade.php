@if ($action->user_id == Auth::user()->id || Auth::user()->role->name == 'admin')
    <div class="d-flex justify-content-center align-items-center gap-2">
        <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#editModal"
            data-bs-id={{ $action->id }}>
            <i class="bi bi-pencil"></i>
        </button>
        <form action="{{ route('actions.destroy', $action->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" type="submit">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    </div>
@endif
