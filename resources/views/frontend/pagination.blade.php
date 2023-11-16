<ul class="pagination">
    @if ($posts->currentPage() > 1)
        <li class="page-item"><a class="page-link" href="{{ $posts->previousPageUrl() }}">&laquo;</a></li>
    @else
        <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
    @endif

    @php
        $maxPages = 10;
        $currentPage = $posts->currentPage();
        $lastPage = $posts->lastPage();
        $startPage = max($currentPage - floor($maxPages / 2), 1);
        $endPage = min($startPage + $maxPages - 1, $lastPage);
    @endphp

    @if ($startPage > 1)
        <li class="page-item"><a class="page-link" href="{{ $posts->url(1) }}">1</a></li>
        
    @endif

    @for ($i = $startPage; $i <= $endPage; $i++)
        <li class="page-item @if ($i === $currentPage) active @endif">
            <a class="page-link" href="{{ $posts->url($i) }}">{{ $i }}</a></li>
    @endfor

    @if ($endPage < $lastPage)
        @if ($endPage < $lastPage - 1)
            <li class="page-item disabled"><span class="page-link">...</span></li>
        @endif
        <li class="page-item"><a class="page-link" href="{{ $posts->url($lastPage) }}">{{ $lastPage }}</a></li>
    @endif

    @if ($posts->hasMorePages())
        <li class="page-item"><a class="page-link" href="{{ $posts->nextPageUrl() }}">&raquo;</a></li>
    @else
        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
    @endif
</ul>