@php
    $trimmed_hash_tag = trim($hashtag, '#');
    $row_id = "{$trimmed_hash_tag}_{$approvable->id}_row";

    $approvement_status = $approvable->approvementStatus();
    $created_by = $approvable->user->full_name;

@endphp
<tr id="{{$row_id}}">
    <td>
        {{ $row_name }}
        @if (isset($delete_route))
        {{-- test-printing --}}
        {{-- @dump($delete_route) --}}
        <span>{{$approvable->diagnosis_type ?? null}}</span>

        <!-- response-messages -->
        <div class="alert alert-success alert-block d-none">
            <button type="button" class="close close-alert-btn">×</button>
            <strong class="alert-content"></strong>
        </div>
        <div class="alert alert-warning alert-block d-none">
            <button type="button" class="close close-alert-btn">×</button>
            <strong class="alert-content"></strong>
        </div>
        @endif
    </td>
    <td>
        {{ $created_by }}
    </td>
    <td>
        {{ $approvement_status }}
    </td>
    <td class="d-flex justify-content-center">
        <a href="{{ route('patients.stationary.show', compact("patient", "stationary")) . $hashtag }}" class="btn btn-info btn-sm" target="_blank">
            <x-svg icon="cui-external-link" />
        </a>

        @can('belongs-to-user', $approvable)
        @if(isset($delete_route))
        <form action="{{$delete_route}}" method="POST" class="ajax-submitable">
            @csrf
            <input type="hidden" name="id" value="{{$approvable->id}}">
            <input type="hidden" name="row_name" value="{{$row_name}}">
            <input type="hidden" name="hideFormId" value="{{$row_id}}">
            <button type="submit" class="btn btn-danger btn-sm mx-1">
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                <x-svg icon="cui-basket" />
            </button>
        </form>
        @endif
        @endcan


        @can('user-can-approve', $approvable)
            <form method="POST" action="{{ route("approvements.update", ["approvement" => $approvable->approvement]) }}" class="d-inline">
                @csrf
                @method("PATCH")
                <button class="btn btn-success btn-sm mx-1" {{ $approvable->approvement->status ? "disabled" : "" }}>
                    <x-svg icon="cui-check" />
                </button>
            </form>
        @endcan
    </td>
</tr>
