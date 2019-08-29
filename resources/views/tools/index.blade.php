@extends('tools.base')
@section('action-content')
<link href="{{ asset('css/estilotabla.css') }}" rel="stylesheet">
<!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!!Html::script('js/jstool.js')!!}
    <!-- Main content -->
    <section class="content">
    @include('alerts.success')
    @include('alerts.errors')
        <div class="table-wrapper">
          <form action="" method="post"> 
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
            <h2>Elementos</h2>
          </div>
          <div class="col-sm-6">
      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            <a class="btn btn-primary add-new" href="{{ route('tool.create') }}"><i class="fa fa-plus"></i> <span>Agregar</span></a>
            <a href="#deleteEmployeeModal" class="btn btn-danger eliminacion" data-toggle="modal"><i class="fa fa-trash" ></i> <span>Eliminar</span></a>
          </div>
                </div>
            </div>
            <div class="table table-responsive" id="tabla_respuesta">             
               <table id="tablaprueba" class="table table-striped table-hover">
                  <thead>
                      <tr>
                      <th>
                        <span class="custom-checkbox">
                          <input type="checkbox" id="selectAll">
                          <label for="selectAll"></label>
                        </span>
                      </th>
                      <th >NOMBRE</th>
                      <th >IMAGEN</th>
                      <th >CATEGORIA</th>
                      <th >SUBCATEGORIA</th>
                      <th >DESCRIPCIÓN</th>
                      <th >CANTIDAD DISPONIBLE</th>
                      <th >EDITAR</th>
                      </tr>
                  </thead>
                  <tbody>
                    
                        
                      @foreach ($tools as $tool)
                      <tr class="checkable">
                          @php ($contador = 0)
                          <td><span class="custom-checkbox">
                             <input type="checkbox" value="{{ $tool->id }}" id="checkbox{{ $contador }}" name="checkbox{{ $contador }}" class="checkbox" >
                                <label for="checkbox{{ $contador }}"></label>
                                    </span>
                            </td>
                           <td>{{ $tool->nombre }}</td>
                           <td><img src="{{$tool->imagen}}" width="80" height="80" /></img></td>
                           <td>{{ $tool->category->nombre}}</td>
                           <td>
                           @if($tool->subcategory)
                           {{ $tool->subcategory->nombre}}
                           @endif
                           </td>
                           <td>{{ $tool->descripcion }}</td>
                           <td>{{ $tool->cantidad_disponible }}</td>
                            <td>
                              <div> <a type="button" href="/tool/{{ $tool->id }}/edit" class="btn btn-default editar  sinborde" id="edit" name="edit" value="{{ $tool->id }}" title="Editar">
                                     <span class="glyphicon glyphicon-edit fa-lg" style="color: blue;" ></span>
                              </a>
                       
                              </div>
                  
                              </td>
                        </tr>
                       @php ($contador++)
                    @endforeach
                       
                  </tbody>
              </table>  
              <div class="clearfix">
                {{ $tools->links() }}
                    
                
            </div>          
            </div>
            </form>
        </div>

         <div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Eliminar Elementos</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Esta seguro de borrar los elementos seleccionadas?</p>
            <p class="text-warning"><small>Recuerde, esta acción no se puede deshacer.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
            <button class="btn btn-danger delete2" data-dismiss="modal">Eliminar</button>
          </div>
      </div>
    </div>
  </div
    </section>


    <!-- /.content -->

@endsection