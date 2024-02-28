<div class="card border-info">
    @if (!empty($title))
    <div class="card-header">
        <h4>{{ $title }}</h4>
        @if (!empty($viewUrl))
        <h6><a href="{{ $viewUrl }}" target="_blank">Նախորդ գրառումեր</a></h6>
        @endif
    </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
