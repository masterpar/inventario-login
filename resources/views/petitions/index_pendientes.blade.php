@extends('petitions.base')
@section('action-content')
    <!-- Main content -->
    <link href="{{ asset('css/estilotabla.css') }}" rel="stylesheet">
    <section class="content">
   <div class="table-wrapper">
          <form action="" method="post">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
            <h2>SOLICITUDES NUEVAS</h2>
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
          <div class="col-sm-6">

            
          </div>
                </div>
            </div>
            <div class="table table-responsive" id="tabla_respuesta">             
               <table id="tablaprueba" class="table table-striped table-hover">
                  <thead>
                      <tr>
                      <th>Solicitud</th>
                      <th >Usuario</th>
                      <th >NIT/CC</th>
                      <th >Fecha solicitud</th>
                      <th >Fecha devolución estimada</th>
                      <th >Ver</th>
                      </tr>
                  </thead>
                  <tbody>

                   @foreach ($petitions as $petition)
                    <tr>
                   <td width="30%">{{ $petition->nombre }}</td>
                  <td>{{ $petition->user->name }}</td>
                  <td>{{ $petition->user->cc }}</td>
                  <td>{{ $petition->created_at }}</td>
                  <td>{{ $petition->f_devolucion }}</td>
                  <td>
                    
                         <div> <a type="button" class="btn btn-default ver  sinborde" href="{{ route('petition.show', ['id' => $petition->id]) }}">
                        <span class="glyphicon glyphicon-eye-open fa-lg" style="color: green;" ></span>
                      </a>
                        
                    </div>
                  </td>
                  </tr>
                   @endforeach

                  </tbody>
              </table>  
              <div class="clearfix">
                
                    {{ $petitions->links() }}
                </ul>
            </div>          
            </div>
            </form>
        
</div>

    </section>
    <!-- /.content -->
  
@endsection