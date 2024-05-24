<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{asset('images/logo.png')}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Curso Laravel</title>    
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" />
    <style>
    .bd-placeholder-img
    {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) 
    { .bd-placeholder-img-lg
        {
            font-size: 3.5rem;
        }
    }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900&amp;display=swap" rel="stylesheet" />
    <link href="{{asset('css/blog.css')}}?id={{ csrf_token() }}" rel="stylesheet" />
    <link href="{{asset('css/jquery.alerts.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{asset('fontawesome-5-8/css/all.css')}}" />
    @stack('css')
</head>
<body>
    <div class="container">
        <header class="border-bottom lh-1 py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    <a class="link-secondary" href="#">Subscribe</a>
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="{{route('template_inicio')}}"><img src="{{asset('images/logo.png')}}" /></a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    <a class="link-secondary" href="#" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
                    </a>
                    <a class="btn btn-sm btn-outline-secondary" href="#">Sign up</a>
                </div>
            </div>
        </header>
        <div class="nav-scroller py-1 mb-3 border-bottom">
            <nav class="nav nav-underline justify-content-between">
                <a class="p-2 link-secondary" href="{{route('template_inicio')}}">Home</a>
                <a class="p-2 link-secondary" href="{{route('formularios_inicio')}}">Formularios</a>
                <a class="p-2 link-secondary" href="{{route('email_inicio')}}">E-mail</a>
                <a class="p-2 link-secondary" href="{{route('bd_inicio')}}">BD</a>
                <a class="p-2 link-secondary" href="{{route('utiles_inicio')}}">Útiles</a>

                @if (Auth::check())
                    <a class="p-2 link-secondary" href="">Hola {{ Auth::user()->name }} ({{ session('perfil') }})</a>
                    @if (session('perfil_id')==1)
                        <a class="p-2 link-secondary" href="{{route('protegida_inicio')}}">Protegida</a>
                    @endif
                    <a class="p-2 link-secondary" href="{{route('protegida_otra')}}">Protegida 2</a>
                    <a class="p-2 link-secondary" href="javascript:void(0);" onclick="confirmaAlert('Realmente desea cerrar la sesión?', '{{route('acceso_salir')}}')">Salir</a>                    
                @else
                    <a class="p-2 link-secondary" href="{{route('acceso_login')}}">Login</a>
                    <a class="p-2 link-secondary" href="{{route('acceso_registro')}}">Registro</a>                    
                @endif
            </nav>
        </div>
    </div>
    
    <main class="container">
        {{-- contenido --}}
        @yield('content')
        {{-- /contenido --}}
    </main>
    
    <footer class="blog-footer">
        <p>&copy; Todos los derechos reservados 2024 | Desarrollado por <a href="https://www.tamila.cl" title="Tamila" target="_blank">Tamila</a>
        </p>
    </footer>

    <script src="{{asset('js/jquery-2.0.0.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/jquery.alerts.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/funciones.js')}}?id={{ csrf_token() }}"></script>
    @stack('js')
</body>
</html>