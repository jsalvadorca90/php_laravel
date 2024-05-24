@extends('../layouts.frontend')

@section('content')
    <h1>formularios</h1>
    <ul>
        <li>
            <a href="{{route('formularios_simple')}}">Simple</a>
        </li>
        <li>
            <a href="{{route('formularios_flash')}}">Flash</a></li>
        <li>
            <a href="{{route('formularios_upload')}}">Upload</a>
        </li>
    </ul>
@endsection