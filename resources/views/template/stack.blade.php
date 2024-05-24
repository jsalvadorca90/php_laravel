@extends('../layouts.frontend')

@section('content')
    <h1>Ejemplo de stack</h1>
    <a href="{{asset('images/yoda.png')}}" class="fancybox">
        <img src="{{asset('images/yoda.png')}}" width="100" height="100">
    </a>
    @push('css')
        <link rel="stylesheet" href="{{asset('fancybox/jquery.fancybox.css')}}">
    @endpush
    @push('js')
        <script src="{{asset('fancybox/jquery.fancybox.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".fancybox").fancybox({
                    openEffect  : 'elastic',
                    closeEffect : 'elastic',
                });
            });
        </script>
    @endpush
@endsection