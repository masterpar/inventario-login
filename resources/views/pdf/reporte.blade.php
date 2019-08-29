<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <title>Reporte petición</title>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                	
     <table class="table table-bordered">
      <tr ALIGN=CENTER>
        <th rowspan="4"><img src="{{ base_path() }}/public/img/ceind.jpg"  width="150" height="150"/></th>
        <th >CENTRO DE INVESTIGACIÓN Y DESARROLLO TECNOLÓGICO DE LOS LLANOS</th>
        <th COLSPAN=2>Código FO-GOP-03</th>
      </tr>
      <tr ALIGN=CENTER>
        <td>PROCESO DE GESTIÓN OPERATIVA</td>
        <td>VERSIÓN: 01</td>
        <td>PÁGINA 1 DE 1</td>
      </tr>
      <tr ALIGN=CENTER>
        <td>FORMATO</td>
        <td COLSPAN=2>FECHA: 12-10-2017</td>
      </tr>
      <tr ALIGN=CENTER>
        <td>FORMATO DE SALIDA E INGRESO DE P.P Y E.</td>
        <td COLSPAN=2>VIGENCIA: 2017</td>
      </tr>
      </table>
      <br>


      <table class="table table-bordered">
        <tr>
          <th COLSPAN="3" BGCOLOR="#EDA10A"><font color="white">SALIDA DEL ARTICULO</font></th>
        </tr>
        <tr ALIGN=CENTER>
          <td COLSPAN="3" BGCOLOR="#33B3F3"><font color="white">Datos Básicos</font></td>
        </tr>
        <tr ALIGN=CENTER>
          <td>Nombre del solicitante: <br> {{$petition->user->name}}</td>
          <td>NIT/CC: <br> {{$petition->user->cc}}</td>
          <td>Tipo de vinculación: <br> {{$petition->user->tipo}}</td>
        </tr>
        <tr ALIGN=CENTER>
          <td>Teléfono: <br> {{$petition->user->telefono}}</td>
          <td>Ciudad: <br> Villavicencio</td>
          <td>Email: <br> {{$petition->user->email}}</td>
        </tr>
        <tr ALIGN=CENTER>
          <td COLSPAN="3" BGCOLOR="#33B3F3"><font color="white">Justificación de Salida:</font></td>
        </tr>
        <tr>
          <td COLSPAN=3>{{$petition->justificacion}}.</td>
        </tr>
        <tr ALIGN=CENTER>
          <td COLSPAN="3" BGCOLOR="#33B3F3"><font color="white">Listado de elementos:</font></td>
        </tr>
        <tr>
          @foreach($petition->petition_tools as $petition_tools)
             <td>{{$petition_tools->tool->nombre}}.</td>
             
          @endforeach
        </tr>

        
      </table>

                </div>
            </div>
        </div>
    </body>
</html>