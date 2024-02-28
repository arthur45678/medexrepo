<div id="{{$modalId}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="{{ $modalId }}"
    aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$title ?? ""}}</h4>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            @if (isset($formId) && !empty($formId))
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Փակել</button>
                <button class="btn btn-primary" type="submit" form="{{ $formId }}">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    Ուղարկել
                </button>
            </div>
            @endif
        </div>
    </div>
</div>
