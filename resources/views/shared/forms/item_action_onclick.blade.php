<div class="bg-secondary p-2">

    <div class="alert alert-success alert-block" style="display: none">
        <button type="button" class="close close-alert-btn">×</button>
        <strong class="alert-content"></strong>
    </div>

    <div class="alert alert-warning alert-block" style="display: none">
        <button type="button" class="close close-alert-btn">×</button>
        <strong class="alert-content"></strong>
    </div>

    <div class="alert alert-danger alert-block" style="display: none">
        <button type="button" class="close close-alert-btn">×</button>
        <strong class="alert-content"></strong>
    </div>

    @if (isset($has_files))
    <div class="progress my-4 d-none">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0"
            aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
    </div>
    @endif

    <button type="submit" class="btn btn-danger" onclick="submit(event)"
        @if (isset($delete_form_id))
            form="{{$delete_form_id}}"
        @endif
        @if (isset($form_action))
            data-action="{{$form_action}}"
        @endif
    >
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="display: none"></span>
        {{ $btn_text ?? "Ջնջել" }}
    </button>
</div>
