@extends('../layouts.frontend')

@section('content')
<h1>BD MySQL</h1>
<ul>
    <li>
        <a href="{{route('bd_categorias')}}">Categorías</a>
    </li>
    <li>
        <a href="{{route('bd_productos')}}">Productos</a>
    </li>
    <li>
        <a href="{{route('bd_productos_paginacion')}}">Paginación</a>
    </li>
    <li>
        <a href="{{route('bd_productos_buscador')}}">Buscador interno</a>
    </li>
</ul>
@endsection