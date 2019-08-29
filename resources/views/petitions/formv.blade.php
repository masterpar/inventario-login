<h3>Datos de la petición</h3>
<div class="form-group">      
  {!!Form::label('nombre','Nombre de la petición:',['class'=>"col-sm-6"])!!}
  <div class="col-md-12">
    {!!Form::text('nombre',null,['class'=>'form-control', 'required'])!!}
  </div>                
</div>


    
<div class="table-responsive">
	<table class="table table-striped table-hover table-bordered form-group">
		<tr>
			<th>Elemento</th>
			<th>Cantidad</th>
		</tr>
		@foreach($cart as $item)
			<tr>
				<td>{{ $item->nombre }}</td>
				<td>{{ $item->cantidad }}</td>
			</tr>
		@endforeach
	</table>
</div>


<div class="form-group">
    <div class="col-md-12">
      {!!Form::label('justificacion','Justificación de la salida:')!!}
      {{ Form::textarea('justificacion', null, ['size' => '30x5', 'class'=>'form-control','required']) }}
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" name="f_devolucion" />
                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>



