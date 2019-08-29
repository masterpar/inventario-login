@extends('users.base')
@section('action-content')
<link href="{{ asset('css/estilotabla.css') }}" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!!Html::script('js/jsuser.js')!!}





    <!-- Main content -->
    <section class="content">
    @include('alerts.success')
    @include('alerts.errors')
        <div class="table-wrapper">
          <form action="" method="post">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
            <h2>USUARIOS</h2>
          </div>
          <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
          <div class="col-sm-6">

            <a class="btn btn-info " href="{{ route('user.create') }}"><i class="fa fa-plus"></i> <span>Agregar</span></a>
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
                      <th >NIT/CC</th>
                      <th >Nombre</th>
                      <th >Teléfono</th>
                      <th >Correo</th>
                      <th >Rol</th>
                      <th >Editar</th>
                      </tr>
                  </thead>
                  <tbody>
                    
                    @php ($contador = 0)
                    @foreach ($users as $user)
                    <tr class="checkable">
                    <td>
                        <span class="custom-checkbox">
                          <input type="checkbox" value="{{ $user->id }}" id="checkbox{{ $contador }}" name="checkbox{{ $contador }}" class="checkbox" >
                          <label for="checkbox{{ $contador }}"></label>
                        </span>
                    </td>
                    <td>{{ $user->cc }}</td>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->telefono }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->tipo }}</td>

                    <td>
                    <div> <a type="button" class="btn btn-default editar  sinborde" id="edit" name="edit" value="{{ $user->id }}" href="/user/{{ $user->id }}/edit">
                        <span class="glyphicon glyphicon-edit fa-lg" style="color: blue;" ></span>
                      </a>
                        
                    </div>
                    </td>
                    @php ($contador++)
                  </tr>
                   @endforeach

                  </tbody>
              </table>  
              <div class="clearfix">
                
                    
                </ul>
            </div>          
            </div>
            </form>
        </div>
    </div>

  <!-- Delete Modal pregunta si desea eliminacion multiple -->
  <div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Eliminar Usuarios</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Esta seguro de borrar los usuarios seleccionadas?</p>
            <p class="text-warning"><small>Recuerde, esta acción no se puede deshacer.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
            <button class="btn btn-danger delete2" data-dismiss="modal">Eliminar</button>
          </div>
      </div>
    </div>
  </div>
  
  


    </section>
    <!-- /.content -->
@endsection

