<div class="d-flex flex-wrap attachments-container">
    @forelse ($attachments as $attachment)
    <span class="attachment badge badge-dark pl-2 m-2">
        <a class="text-white" href="{{$attachment->full_path}}" target="_blank">{{ $attachment->attachment_name }}</a>
        <button type="button" class="btn btn-sm btn-danger ml-1 deletes-attachment"
            data-attachment="{{$attachment->id}}">
            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            <x-svg icon="cui-trash" />
        </button>
    </span>
    @empty

    @endforelse
</div>
