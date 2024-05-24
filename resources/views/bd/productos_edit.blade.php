@extends('../layouts.frontend')

@section('content')
    <h1>BD MySQL</h1>
    <x-flash/>
    <form action="{{route('bd_productos_edit_post', ['id'=>$producto->id])}}" method="POST">
        <div class="form-group">
            <label for="categoria">Categoría: </label>
            <select class="form-control" name="categorias_id" id="categorias_id">
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}" {{($producto->categorias_id==$categoria->id) ? 'selected' :''}}>{{$categoria->nombre}}</option>
                @endforeach  
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{$producto->nombre}}">
        </div>
        <div class="form-group">
            <label for="precio">Precio: </label>
            <input type="text" name="precio" id="precio" class="form-control" value="{{ $producto->precio }}" onkeypress="return soloNumeros(event)" />
        </div>
        <div class="form-group">
            <label for="stock">Stock: </label>
            <select class="form-control" name="stock" id="stock">
                @for ($i=1 ; $i<=100 ; $i++)
                    <option value="{{$i}}" {{($producto->stock==$i) ? 'selected' :''}}>{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción: </label>
            <textarea name="descripcion" id="descripcion" class="form-control">{{ $producto->descripcion }}</textarea>
        </div>
        <hr>
        {{csrf_field()}}
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
@endsection