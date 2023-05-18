<nav class="pagination-container">
    <div class="pagination">

        @if($select_page >=2)
        <a class="pagination-newer" href="{{url('/')}}?select_page={{$select_page-1}}">PREV</a>
        @endif
        
        <span class="pagination-inner">
            @for($i=1; $i<=$max_page; $i++)
                @if($i == $select_page)
                <a class="pagination-active">{{ $i }}</a>
                @else
                <a href="{{url('/')}}?select_page={{$i}}">{{ $i }}</a>
                @endif
            @endfor
        </span>

        @if($select_page != $max_page)
        <a class="pagination-older" href="{{url('/')}}?select_page={{$select_page+1}}">NEXT</a>
        @endif
    </div>
</nav>