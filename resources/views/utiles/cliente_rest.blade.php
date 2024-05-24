@extends('../layouts.frontend')

@section('content')
    <h1>Cliente Rest</h1>
    <h2>Status: {{$status}}</h2>
    <p>{{$json}}</p>
    <p> {{print_r($headers)}}</p>
    <table class="table table-boredered">
        <thead>
            <tr>
                <th>idDependencia</th>
                <th>nombreDependencia</th>
                <th>codigoFacultad</th>
                <th>nombreFacultad</th>
                <th>idConcepto</th>
                <th>codigoConcepto</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                foreach($datos as $dato)
                {
            ?>
            <tr>
                <td><?php echo $dato->idDependencia;?></td>
                <td><?php echo $dato->nombreDependencia;?></td>
                <td><?php echo $dato->codigoFacultad;?></td>
                <td><?php echo $dato->nombreFacultad;?></td>
                <td><?php echo $dato->idConcepto;?></td>
                <td><?php echo $dato->codigoConcepto;?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
@endsection