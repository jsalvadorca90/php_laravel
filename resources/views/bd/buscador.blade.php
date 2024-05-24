@extends('../layouts.frontend')

@section('content')
    <h1>BD MySQL Buscador</h1>
    <h3>Resultados para el término: <strong>{{$b}}</strong></h3>
    <x-flash/>
    <div class="row">
        <div class="col-6">
        </div>
        <div class="col-6">
            <form name="form_buscador" action="{{route('bd_productos_buscador')}}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Buscar....." name="b" id="b" value="{{$b}}">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="buscador();"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <hr/>
    <p class="d-flex justify-content-end">
        <a href="{{route('bd_productos_add')}}" class="btn btn-success"><i class="fas fa-check"></i>Crear</a>
    </p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <th>ID</th>
                <th>Categoría</th>
                <th>Nombre</th>
                <th>Precio</th>
                
                <th>Stock</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Fotos</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                @foreach($datos as $dato)
                    <tr>
                        <td>{{ $dato->id }}</td>
                        <td>
                            <a href="{{route('bd_productos_categorias', ['id'=>$dato->categorias_id])}}">{{$dato->categorias->nombre}}</a>
                        </td>
                        <td>{{ $dato->nombre }}</td>
                        <td>${{number_format($dato->precio, 0, '', '.')}}</td>
                        <td>{{ $dato->stock }}</td>
                        <td>{{substr($dato->descripcion, 0, 50)}}.....</td>
                        <td>{{ $dato->fecha }}</td>
                        <td>
                            <a href="{{route('bd_productos_fotos', ['id'=>$dato->id])}}"><i class="fas fa-camera"></i></a>
                        </td>
                        <td>
                            <a href="{{route('bd_productos_edit', ['id'=>$dato->id])}}" ><i class="fas fa-edit"></i></a>
                            <a href="javascript:voi(0);" onclick="confirmaAlert('Realmente desea eliminar este registro?', '{{route('bd_productos_delete', ['id'=>$dato->id])}}');"><i class="fas fa-trash"></i></a>
                            {{-- <form action="{{ route('mysql.destroy', $mysql->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection