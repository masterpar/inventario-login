@extends('users.base')
@section('action-content')
<link href="{{ asset('css/solo_alertas.css') }}" rel="stylesheet">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
{!!Html::script('js/show_petition.js')!!}
    <!-- Main content -->
    <section class="content">
    @include('alerts.success')
    @include('alerts.errors')

      <div class="box">
 
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>

    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">        
        
        <!-- tabla detalles Petición -->
        <table class="table table-bordered">
            <tr>
              <th>Solicitud:</th>
              <td>{{$petition->nombre}}</td>
            </tr>
            <tr>
              <th>Estado:</th>
              <td style="font-size:110%;">
                  @if($petition->estado == 'Pendiente')
                      <span class="label label-warning">{{$petition->estado}}</span>
                  @endif
                  @if($petition->estado == 'Aprobada')
                      <span class="label label-success">{{$petition->estado}}</span>
                  @endif
                  @if($petition->estado == 'Rechazada')
                      <span class="label label-danger">{{$petition->estado}}</span>
                  @endif
                  @if($petition->estado == 'Revisión')
                      <span class="label label-warning">{{$petition->estado}}</span>
                  @endif
                  @if($petition->estado == 'Finalizada')
                      <span class="label label-primary">{{$petition->estado}}</span>
                  @endif
              </td>
            </tr>
            <tr>
              <th>Solicitud realizada por:</th>
              <td>{{$petition->user->name}}</td>
            </tr>
            <tr>
              <th>NIT/CC:</th>
              <td>{{$petition->user->cc}}</td>
            </tr>
            <tr>
              <th>Télefono:</th>
              <td>{{$petition->user->telefono}}</td>
            </tr>
            <tr>
              <th>Fecha de solicitud:</th>
              <td>{{$petition->created_at}}</td>
            </tr>
              @if($petition->f_apartada != null)
              <tr>
                <th>Fecha apartar hasta:</th>
                <td>{{$petition->f_apartada}}</td>
              </tr>
              @endif
            <tr>
              <th>Fecha devoluación estimada:</th>
              <td>{{$petition->f_devolucion}}</td>
            </tr>
            <tr>
              <th>Justificación de la salida:</th>
              <td>{{$petition->justificacion}}</td>
            </tr>
      </table>
      

          <table class="table table-bordered">
            <tr >
                <th class="text-center" width="10%">Elemento</th>
                <th class="text-center" width="10%">Imagen</th>
                <th class="text-center" width="10%">Cantidad solicitada</th>
                <th class="text-center" width="10%">Cantidad aprobada</th>

                  @if($petition->estado == 'Pendiente' and Auth::user()->tipo == 'Admin')
                    <th class="text-center" width="10%">Cantidad disponible</th>
                  @endif

                @if($petition->estado == 'Aprobada' and Auth::user()->tipo != 'Admin' and $petition->f_apartada == null)
                  <th class="text-center" width="10%">Devolver elemento</th>
                @endif

                @if($petition->estado == 'Aprobada' and Auth::user()->tipo != 'Admin' and $petition->recogida == '1')
                  <th class="text-center" width="10%">Devolver elemento</th>
                @endif

                @if($petition->estado != 'Pendiente' and Auth::user()->tipo == 'Admin')
                  <th class="text-center" width="10%">Elementos devueltos</th>
                @endif

            </tr>
            <tbody>
        
            @php ($cont = 0)
            @php ($cant_total_devuelto = 0)
             @foreach ($petitiontools as $petitiontool)
                
            <tr align="center">
                <td>{{$petitiontool->tool->nombre}}</td>
                <td><img src={{$petitiontool->tool->imagen}} width="80" height="80" /></img></td>
                <td>{{$petitiontool->cantidad}}</td>
                <td> @if($petition->estado == 'Pendiente' and Auth::user()->tipo == 'Admin')
                          <input 
                              type="number"
                              min="0"
                              max="{{$petitiontool->cantidad}}"
                              value="{{ $petitiontool->cantidad_aprobada }}"
                              id="product_{{ $petitiontool->tool->id }}"
                              required
                          >
                          <a 
                              href="#" 
                              class="btn btn-warning btn-update-tool-cant btn-rounded "
                              data-href="{{ route('tool-cant',$petition->id ) }}"
                              data-id = "{{ $petitiontool->tool->id }}"
                          >
                              <i class="fa fa-refresh"></i>
                          </a
                        @php ($cont = $cont + $petitiontool->cantidad_aprobada)
                    @else
                      {{ $petitiontool->cantidad_aprobada }}
                    @endif


                </td>
                @if($petition->estado == 'Pendiente' and Auth::user()->tipo == 'Admin')
                <td>{{$petitiontool->tool->cantidad_disponible}}</td>

                @endif


                @if($petition->estado == 'Aprobada' and Auth::user()->tipo != 'Admin' and $petition->f_apartada == null)
                <td> @php ($cant_total_devuelto = $cant_total_devuelto + $petitiontool->cantidad_devuelta)
                      <input 
                              type="number"
                              min="0"
                              max="{{$petitiontool->cantidad_aprobada}}"
                              value="{{ $petitiontool->cantidad_aprobada }}"
                              id="product_{{ $petitiontool->tool->id }}"
                              required
                          >
                          <a 
                              href="" 
                              class="btn btn-warning btn-update-tool-dev btn-rounded "
                              data-href="{{ route('tool-dev',$petition->id ) }}"
                              data-id = "{{ $petitiontool->tool->id }}"
                          >
                              <i class="fa fa-refresh"></i>
                          </a
                </td>
                @endif

                @if($petition->estado == 'Aprobada' and Auth::user()->tipo != 'Admin' and $petition->recogida == '1')
                <td>
                      <input 
                              type="number"
                              min="{{ $petitiontool->cantidad_devuelta }}"
                              max="{{$petitiontool->cantidad_aprobada}}"
                              value="{{ $petitiontool->cantidad_devuelta }}"
                              id="product_{{ $petitiontool->tool->id }}"
                              required
                          >
                          <a 
                              href="#" 
                              class="btn btn-warning btn-update-tool-dev btn-rounded "
                              data-href="{{ route('tool-dev',$petition->id ) }}"
                              data-id = "{{ $petitiontool->tool->id }}"
                          >
                              <i class="fa fa-refresh"></i>
                          </a
                </td>
                @endif
                @if($petition->estado != 'Pendiente' and Auth::user()->tipo == 'Admin')
                <td>{{$petitiontool->cantidad_devuelta}}</td>
                @endif

            </tr>
            @endforeach
            </tbody>  
          </table>

     


     @if($petition->estado != 'Pendiente' ||  $petition->estado != 'Rechazada' and Auth::user()->tipo == 'Admin')
     <p><strong>Observación de la solicitud:</strong></p>
     <p>{{$petition->observacion}}</p>
     <p><strong>Observación Admin:</strong></p>
         <p>{{$petition->observacion_admin}}</p>
     @endif

     @if($petition->estado != 'Rechazada' || $petition->estado != 'Pendiente'   and Auth::user()->tipo != 'Admin')
         <p><strong>Observación de la solicitud:</strong></p>
         <p>{{$petition->observacion}}</p>
         <p><strong>Observación Admin:</strong></p>
         <p>{{$petition->observacion_admin}}</p>
      @endif

       @if($petition->estado == 'Aprobada' and Auth::user()->tipo != 'Admin')
      <p><strong>Mi Observación:</strong></p>
      <form class="row" method="POST" action="{{ route('petition.comentar', ['id' => $petition->id]) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <div class="col-md-12">
          <textarea rows="8" cols="100" name="observacion">{{$petition->observacion}}</textarea>
          </div>
        <div class="col-md-12">
        <button type="submit" class="btn btn-info ">Guardar</button>
        </div>
        </div>
        </form>  
      @endif

      @if(($petition->estado == 'Aprobada' || $petition->estado == 'Revisión') and Auth::user()->tipo == 'Admin')
      <p><strong>Mi Observación:</strong></p>
      <form class="row" method="POST" action="{{ route('petition.comentar2', ['id' => $petition->id]) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <div class="col-md-12">
          <textarea rows="8" cols="100" name="observacion_admin">{{$petition->observacion_admin}}</textarea>
          </div>
        <div class="col-md-12">
        <button type="submit" class="btn btn-info ">Guardar</button>
        </div>
        </div>
        </form>  
      @endif

     <hr>
    <p>
      @if($petition->estado == 'Pendiente' and Auth::user()->tipo == 'Admin')
    @if($cont == 0)
      <form class="row" method="POST" id="form_aprobar" action="{{ route('petition.aprobartodo', ['id' => $petition->id]) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <a href="#aprobarModal" data-toggle="modal" class="btn btn-success  btn-margin">Aprobar todo
                          <i class="fa fa-play"></i>
                        </a>
        </form>
   @endif
         @if($cont != 0)
         <p>
         
        <form class="row" method="POST" id="form_confirmar" action="{{ route('petition.aprobar', ['id' => $petition->id]) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <a href="#confirmarModal" data-toggle="modal" class="btn btn-warning  btn-margin">Confirmar aprobación
                          <i class="fa fa-play"></i>
                        </a>
        </form>
        
        @endif
<form class="row" method="POST" id="form_rechazar" action="{{ route('petition.rechazar', ['id' => $petition->id]) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <a href="#rechazarModal" data-toggle="modal" class="btn btn-danger  btn-margin">Rechazar
                          <i class="fa fa-play"></i>
                        </a>
         
        </form> 
      @endif

     
  

      @if($petition->estado == 'Aprobada' and Auth::user()->tipo != 'Admin' and $petition->f_apartada == null)
        <form class="row" method="POST" id="form_devolvert" action="{{ route('petition.devolver', ['id' => $petition->id]) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <a href="#devolvertModal" data-toggle="modal" class="btn btn-success btn-margin">Devolver todo
                          <i class="fa fa-play"></i>
                        </a>

        </form>  

      @endif

      @if($petition->estado == 'Aprobada' and Auth::user()->tipo != 'Admin' and $petition->recogida == '1' and $cant_total_devuelto == 0)
       <form class="row" method="POST" id="form_devolvert" action="{{ route('petition.devolver', ['id' => $petition->id]) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <a href="#devolvertModal" data-toggle="modal" class="btn btn-success btn-margin">Devolver todo
                          <i class="fa fa-play"></i>
                        </a>

        </form> 

      @endif

      @if($petition->estado == 'Revisión' and Auth::user()->tipo == 'Admin')

        <form class="row" method="POST" id="form_finalizar" action="{{ route('petition.finalizar', ['id' => $petition->id]) }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <a href="#finalizarModal" data-toggle="modal" class="btn btn-success col-sm-1 col-xs-5 btn-margin">Finalizar
                          <i class="fa fa-play"></i>
                        </a>

        </form>  
      @endif
      @if($petition->estado == 'Aprobada' || $petition->estado == 'Finalizada' || $petition->estado == 'Revisión')
       <a href="{{ route('petition.pdf', ['id' => $petition->id]) }}" class="btn btn-sm btn-primary">
            Descargar solicitud en PDF
       </a>
        
      </div>
      @endif
    </p>
    </div>
  </div>
  <!-- /.box-body -->
</div>

<div id="confirmarModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Confirmar Solicitud</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Está seguro de confirmar esta solicitud?</p>
            <p class="text-warning"><small>Recuerde, esta acción no se puede deshacer.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
            <button class="btn btn-danger confirmar" data-dismiss="modal">Confirmar</button>
          </div>
      </div>
    </div>
  </div>

  <div id="aprobarModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Aprobar todo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Está seguro de aprobar todos los elementos de esta solicitud?</p>
            <p class="text-warning"><small>Recuerde, esta acción no se puede deshacer.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
            <button class="btn btn-danger aprobar" data-dismiss="modal">Aprobar todo</button>
          </div>
      </div>
    </div>
  </div>

  <div id="rechazarModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Rechazar</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Está seguro de rechazar esta solicitud?</p>
            <p class="text-warning"><small>Recuerde, esta acción no se puede deshacer.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
            <button class="btn btn-danger rechazar" data-dismiss="modal">Rechazar</button>
          </div>
      </div>
    </div>
  </div>

<div id="devolvertModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Devolver todo</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Se devolverán todos los elementos y la petición pasará a revisión</p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
            <button class="btn btn-danger devolvert" data-dismiss="modal">Devolver todo</button>
          </div>
      </div>
    </div>
  </div>

  <div id="finalizarModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Finalizar</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Está seguro que desea finalizar esta petición?</p>
            <p class="text-warning"><small>Recuerde, esta acción no se puede deshacer.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
            <button class="btn btn-danger finalizar" data-dismiss="modal">Finalizar</button>
          </div>
      </div>
    </div>
  </div>

  

    </section>
    <!-- /.content -->

@endsection