@extends('petitions.base')
@section('action-content')
    <!-- Main content -->
    <link href="{{ asset('css/estilotabla.css') }}" rel="stylesheet">
    <section class="content">
   <div class="table-wrapper">
          
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6 ">
                       <h2 >MIS SOLICITUDES</h2>
                    </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                </div>
            </div>

            <div class="table table-responsive" id="tabla_respuesta">             
                <table id="tablaprueba" class="table table-striped table-hover">
                    <thead>
                        <tr>
                        <th>Solicitud</th>
                        <th >Fecha solicitud</th>
                        <th >Estado</th>
                        <th >Ver</th>
                        </tr>
                    </thead>
                  <tbody>

                   @foreach ($petitions as $petition)
                      <tr>
                          <td width="30%">{{ $petition->nombre }}</td>
                              <td>{{ $petition->created_at }}</td>
                              <td>{{ $petition->estado }}</td>
                              <td>                    
                                      <a type="button" class="btn btn-default ver  sinborde" href="{{ route('petition.show', ['id' => $petition->id]) }}">
                                    <span class="glyphicon glyphicon-eye-open fa-lg" style="color: green;" ></span>
                                  </a>                    
                                              
                                  @if($petition->f_apartada <= date("Y-m-d") and $petition->estado == 'Aprobada' and $petition->f_apartada != null and $petition->recogida == null)
                                  <form class="row" method="POST" action="{{ route('petition.pedirele', ['id' => $petition->id]) }}" name="form">               

                                  <input type="hidden" name="_method" value="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                    <button type="submit" class="btn  btn-info btn-md sinborde" ata-toggle="tooltip" data-placement="top" title="Pedir elementos">
                                      <i class="fa fa-hand-stop-o fa-lg" style="color: blue;"></i>
                                    </button>
                                  </form>     

                                  @endif                   
                                    
                              </td>

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
        
    </div>

    </section>
    <!-- /.content -->
  
@endsection