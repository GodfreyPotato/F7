@if ($paginator->hasPages())
    <nav class="mt-5">
        <ul class="pagination justify-content-center" style="margin: 0;">

            {{-- Prev Button --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link fw-bold text-primary"
                        style="border:none; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin: 0 4px;">
                        Prev
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link fw-bold text-primary" href="{{ $paginator->previousPageUrl() }}"
                        style="border:none; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin: 0 4px;">
                        Prev
                    </a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link"
                                    style="border-radius: 8px; width: 40px; height: 40px; background-color: #1D4ED8; color: white; border: none; display: flex; align-items: center; justify-content: center; margin: 0 4px;">
                                    {{ $page }}
                                </a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}"
                                    style="border-radius: 8px; width: 40px; height: 40px; background-color: #f8f9fa; color: #ccc; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center; margin: 0 4px;">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link fw-bold text-primary" href="{{ $paginator->nextPageUrl() }}"
                        style="border:none; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin: 0 4px;">
                        Next
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link fw-bold text-primary"
                        style="border:none; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; margin: 0 4px;">
                        Next
                    </span>
                </li>
            @endif

        </ul>
    </nav>
@endif
