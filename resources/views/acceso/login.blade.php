@extends('../layouts.frontend')

@section('content')
    <h1>Login</h1>
    <x-flash/>
    <form action="{{route('acceso_login_post')}}" method="POST">
        <div class="form-group">
            <label for="correo">E-Mail: </label>
            <input type="text" name="correo" id="correo" class="form-control" value="{{ old('correo') }}">
        </div>
        <div class="form-group">
            <label for="password">Contraseña: </label>
            <input type="password" name="password" id="password" class="form-control">
        </div>
        <hr>
        {{ csrf_field() }}     
        <input type="submit" value="Enviar" class="btn btn-primary">
    </form>
@endsection