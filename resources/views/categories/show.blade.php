@extends('categories.base')
@section('action-content')
<link href="{{ asset('css/estilotabla.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!!Html::script('js/jssubcategory.js')!!}


    <!-- Main content -->
    <section class="content">

        <div class="table-wrapper">
          <form action="" method="post">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
            <h2>SUBCATEGORÍAS DE {{ $category->nombre }}</h2>
          </div>
          <div class="col-sm-6">

            <a class="btn btn-info add-new" data-toggle="modal" data-target="#add_data_Modal"><i class="fa fa-plus"></i> <span>Agregar</span></a>
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
                      <th >EDITAR</th>
                      </tr>
                  </thead>
                  <tbody>
                   

                  </tbody>
              </table>  
              <div class="clearfix">
                
                    
                </ul>
            </div>          
            </div>
            </form>
        </div>
    </div>

  <!-- Delete Modal pregunta si decea eliminacion multiple -->
  <div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Eliminar Subcategorías</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Esta seguro de borrar las subcategorías seleccionadas?</p>
            <p class="text-warning"><small>Recuerde, esta acción no se puede deshacer.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
            <button class="btn btn-danger delete2" data-dismiss="modal">Eliminar</button>
          </div>
      </div>
    </div>
  </div>
  
    <!-- Modal error de eliminacion -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">ERROR</h4>
        </div>
        <div id="mensajeerror" name="mensajeerror" class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
  </div>
  
      <!-- Modal error de eliminacion -->
  <div id="ventanaresolucion" title="" style="display:none;">
    <iframe id="frameresolucion" width="100%" height="100%"></iframe>
</div>
     <!-- Modal add -->
  <div id="add_data_Modal" class="modal fade">
   <div class="modal-dialog">
    <div class="modal-content">
    {!!Form::open()!!}
     <div class="modal-header" style="background-color: #435d7d;">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Subcategoría</h4>
     </div>
     <div class="modal-body">
      
     
       <label>NOMBRE: </label>
       <input class="form-control" type="text" id="nombre" name="nombre">
       <br />

      <input class="form-control" type="hidden" id="viejo" name="viejo" >
      <input class="form-control" type="hidden" id="category" name="category" value="{{$category->id}}">
      
      <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
      
     </div>
     <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <input type="button" name="insert" id="insert" value="GUARDAR" class="btn btn-success insert" />
     </div>
    {!!Form::close()!!}
    </div>
   </div>

    </section>
    <!-- /.content -->

@endsection

