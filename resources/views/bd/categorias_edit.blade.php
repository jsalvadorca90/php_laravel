@extends('../layouts.frontend')

@section('content')
    <h1>BD MySQL</h1>
    <x-flash/>
    <form action="{{route('bd_categorias_edit_post', ['id'=>$categoria->id])}}" method="POST">
        <div class="form-group">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="{{$categoria->nombre}}">
        </div>
        <hr>
        {{csrf_field()}}
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
@endsection