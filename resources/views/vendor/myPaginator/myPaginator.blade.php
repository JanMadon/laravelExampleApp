@php
    
@endphp

@if($paginator->hasPages())
<nav>
    <div class="paginator" >

        @if ($paginator->onFirstPage())
        <li><a><</a></li>
        @else
        <li><a href="{{$paginator->previousPageUrl()}}"><</a></li>
        @endif

        @foreach ($elements as $element)
            @foreach ($element as $page => $url)
                <li><a href="{{$url}}">{{$page}}</a></li>
            @endforeach

        @endforeach


        @if ($paginator->hasMorePages())
            <li><a href="{{$paginator->nextPageUrl()}}">></a></li>
        @else
            <li><a>></a></li>

        @endif
    </div>
</nav>

<style>
    ul {
    list-style: none;
}

li  {
    display: inline-block;
    margin-right: 10px; /* Opcjonalne: Dodaje odstęp między elementami li */
}
a {
    color: black;
    font-size: larger;
    font-weight: bold
}

.paginator {
    display: flex;
    justify-content: center;
    align-items: center;

}
</style>


@endif

