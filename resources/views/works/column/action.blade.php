<div class="d-flex justify-content-center align-items-center gap-2">
    <a class="btn btn-sm btn-primary" href="{{ route('works.actions.index', $work->id) }}">
        <i class="bi bi-eye"></i>
    </a>
    @role('admin')
        <button class="btn btn-sm btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#editModal"
            data-bs-id={{ $work->id }}>
            <i class="bi bi-pencil"></i>
        </button>
        <form action="{{ route('works.destroy', $work->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" type="submit">
                <i class="bi bi-trash"></i>
            </button>
        </form>
    @endrole
</div>
