<!-- shared.forms.list_group_item_submit.blade.php -->
<li class="list-group-item list-group-item-secondary">

    <div class="alert alert-success alert-block d-none">
        <button type="button" class="close close-alert-btn">×</button>
        <strong class="alert-content"></strong>
    </div>

    <div class="alert alert-warning alert-block d-none">
        <button type="button" class="close close-alert-btn">×</button>
        <strong class="alert-content"></strong>
    </div>

    <div class="alert alert-danger alert-block d-none">
        <button type="button" class="close close-alert-btn">×</button>
        <strong class="alert-content"></strong>
    </div>

    @if (isset($has_files))
    <div class="progress my-4 d-none">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0"
            aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
    </div>
    @endif
    <button type="submit" class="btn btn-primary">
        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
        {{ $btn_text ?? "Պահպանել" }}
    </button>

    @if (isset($delete_form_id))
        <button form='{{$delete_form_id}}' class="btn btn-danger">
            ջնջել
        </button>
    @endif

</li>
