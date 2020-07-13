<style type="text/css">
.pagination {
    display: -ms-flexbox;
    flex-wrap: wrap;
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem;
}
</style>

@if ($paginator->hasPages())

<div class="container">
    <nav class="nav d-flex justify-content-center">
        <ul class="pagination pagination-sm flex-sm-wrap">


            {{--Pagina Anterior--}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="page-link" aria-hidden="true">{!! __('pagination.previous') !!}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">{!! __('pagination.previous') !!}</a>
                </li>
            @endif

            {{-- Elemento por paginas --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{--Proxima pagina--}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">{!! __('pagination.next') !!}</a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="page-link" aria-hidden="true">{!! __('pagination.next') !!}</span>
                </li>
            @endif
        </ul>
    </nav>
           {{--Mostrar cantidad de registros y paginas--}}
            <div class="container">
                
                    <p class="text-sm text-gray-700 leading-5">
                        {!! __('pagination.Showing') !!}
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('pagination.to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                        {!! __('pagination.of') !!}
                        <span class="font-medium">{{ $paginator->total() }}</span>
                        {!! __('pagination.results') !!}
                    </p>
                
            </div>
</div>    
@endif
