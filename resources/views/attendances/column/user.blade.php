<div class="d-flex flex-wrap align-items-center gap-2">
    <span class="fw-medium"> {{ $user->name }}</span>
    @if ($role->name === 'admin')
        <i class="bi bi-patch-check-fill text-primary"></i>
    @endif
</div>
<span class="text-muted"> {{ $user->email }}</span>
