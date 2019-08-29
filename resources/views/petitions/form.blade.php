<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
    <label for="nombre" class="col-md-4 control-label">Nombre de la petición: </label>

    <div class="col-md-6">
        {!!Form::text('nombre',null,['class'=>'form-control','required' ,'autofocus'])!!}

        @if ($errors->has('nombre'))
            <span class="help-block">
                <strong>{{ $errors->first('nombre') }}</strong>
            </span>
        @endif
    </div>
</div>


<div class="col-md-9 col-md-offset-1">   
                              <table class="table table-bordered">
                                <tr>
                            <th>Elemento</th>
                            <th>Imagen</th>
                            <th>Cantidad</th>
                        </tr>
                        @foreach($cart as $item)
                            <tr>
                                <td>{{ $item->nombre }}</td>
                                <td><img src="{{ $item->imagen }}" width="60" height="60"/></td>
                                <td>{{ $item->cantidad }}</td>
                            </tr>
                        @endforeach
                              </table>
                        </div>




<div class="form-group{{ $errors->has('justificacion') ? ' has-error' : '' }}">
    <label for="justificacion" class="col-md-4 control-label">Justificación de la salida: </label>

    <div class="col-md-6">
        {{ Form::textarea('justificacion', null, ['size' => '30x5', 'class'=>'form-control','required']) }}
        @if ($errors->has('justificacion'))
            <span class="help-block">
                <strong>{{ $errors->first('justificacion') }}</strong>
            </span>
        @endif
    </div>
</div>

<div class="form-group">
    <label for="" class="col-md-4 control-label">Apartar: </label>

    <div class="col-md-6">
        
                  <div class="checkbox">
  <label><input type="checkbox" id="check" value="" class="apartar"  onchange="javascript:mostrar_apartar()"></label>
</div>
            
    
    </div>
</div>




<div class="form-group{{ $errors->has('f_apartada') ? ' has-error' : '' }} f_apartada">
                <label for="f_apartada" class="col-md-4 control-label">Fecha apartar: </label>
        <div class="col-md-6">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text"  autocomplete="off" class="form-control pull-right" id="f_apartada" name="f_apartada">
                  @if ($errors->has('f_apartada'))
            <span class="help-block">
                <strong>{{ $errors->first('f_apartada') }}</strong>
            </span>
        @endif
                </div>
                <!-- /.input group -->
        </div>
 </div>


 <div class="form-group{{ $errors->has('f_devolucion') ? ' has-error' : '' }}">
                <label for="f_devolucion" class="col-md-4 control-label">Fecha devolución: </label>
        <div class="col-md-6">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text"  autocomplete="off" class="form-control pull-right" id="datepicker" name="f_devolucion">
                  @if ($errors->has('f_devolucion'))
            <span class="help-block">
                <strong>{{ $errors->first('f_devolucion') }}</strong>
            </span>
            
        @endif
     

                </div>
                <span class="error_apartado">
                
            </span>
                <!-- /.input group -->
        </div>

 </div>



            

          