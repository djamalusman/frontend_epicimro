
<ul class="pager">
    @if ($data->onFirstPage())
        <li><a href="{{ $data->previousPageUrl() }}" class="pager-prev" aria-disabled="true" title="Previous"></a></li>
    @else
        <li><a href="{{ $data->previousPageUrl() }}" class="pager-prev"title="Previous"></a></li>
    @endif

    @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)
        @if ($page == $data->currentPage())
            <li><a class="pager-number active" href="#" data-page="{{ $page }}">{{ $page }}</a></li>
        @else
            <li><a class="pager-number" href="{{ $url }}" data-page="{{ $page }}">{{ $page }}</a></li>
        @endif
    @endforeach

    @if ($data->hasMorePages())
        <li><a class="pager-next" href="{{ $data->nextPageUrl() }}" data-page="{{ $data->currentPage() + 1 }}"title="Next"></a></li>
    @else
        <li><a class="pager-next" href="#" aria-disabled="true"title="Next"></a></li>
    @endif
</ul>
