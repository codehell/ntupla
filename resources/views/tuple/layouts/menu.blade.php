
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
    <form class="navbar-form navbar-left" action="{{ request()->url() }}" method="get">
        <div class="form-group">
            <input id="search" type="text" class="form-control" name="search" placeholder="Search" value="{{ request('search') }}">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
    </form>
</li>
