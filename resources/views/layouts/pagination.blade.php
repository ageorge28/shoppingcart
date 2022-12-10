<div class="row">
    <div class="col-lg-12 text-center">
        <div class="pagination-wrap">
            <ul>
                @if($paginator->onFirstPage())
                    <li>Previous</li>
                @else
                <li><a href="{{ $paginator->previousPageUrl() }}">Previous</a></li>    
                @endif
                
                @for($i =1; $i<=$paginator->lastPage(); $i++)
                    @php
                        $class = '';
                        if ($paginator->currentPage() == $i)
                        {
                            $class = 'active';
                        }
                    @endphp
                    <li><a href="{{ $paginator->url($i) }}" class="{{ $class }}">{{ $i }}</a></li>
                @endfor
                
                @if($paginator->hasMorePages())
                    <li><a href="{{ $paginator->nextPageUrl() }}">Next</a></li>
                @else
                    <li>Next</li>
                @endif
                    
            </ul>
        </div>
    </div>
</div>