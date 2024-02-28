<li class="list-group-item bg-secondary">
    <blockquote class="blockquote">
        <p class="mb-0">
            {{ $slot }}
        </p>
        <footer class="blockquote-footer">
            <cite title="{{ $sourceTitle }}">{{ $source }}</cite>
        </footer>
    </blockquote>
</li>
