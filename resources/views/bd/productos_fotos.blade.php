@extends('../layouts.frontend')

@section('content')
    <h1>Fotos del producto: {{$producto->nombre}}</h1>
    <x-flash/>
    <form action="{{route('bd_productos_fotos_post', ['id'=>$producto->id])}}" method="POST" name="form" enctype="multipart/form-data">
        <div class="row">
            <div class="form-group izquierda">
                <label for="foto">Foto</label>
                <input type="file" name="foto" id="foto" class="form-control">
            </div>
        </div>
        <hr>
        {{ csrf_field() }}
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
    <hr>
    <div class="row">
        <table class="table table-bordered">
            <thread>
                <tr>
                    <th>Foto</th>
                    <th>Acciones</th>
                </tr>
            </thread>
            <tbody>
                @foreach ($fotos as $foto)
                    <tr>
                        <td>
                            <img src="{{asset('uploads/productos')}}/{{$foto->nombre}}" width="200" height="200">
                        </td>
                        <td>
                            <a href="javascript:void(0);" onclick="confirmaAlert('Realmente desea eliminar este registro?', '{{route('bd_productos_fotos_delete', ['producto_id'=>$producto->id, 'foto_id'=>$foto->id])}}')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection