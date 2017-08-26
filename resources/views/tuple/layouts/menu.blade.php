
<li role="presentation" class="dropdown">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
        Categorias <span class="caret"></span>
    </a>
    <ul class="dropdown-menu">
        @foreach ($categories as $category)
            <li><a href="{{ route('tuple.index', $category->slug) }}">{{ $category->name }}</a></li>
        @endforeach
    </ul>
</li>
<li>
    <form action="{{ route('tuple.index') }}" method="get">

    </form>
</li>
