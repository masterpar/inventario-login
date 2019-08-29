
<div class="form-group">
<div class="col-md-12">
	{!!Form::label('elemento','Elemento: ')!!}
	<p class="form-control">{{$tool->nombre}}</p>
	</div>
</div>

<div class="form-group">
    <div class="col-md-12">
      {!!Form::label('justificacion','Justificación de la salida:')!!}
      {{ Form::textarea('justificacion', null, ['size' => '30x5', 'class'=>'form-control','required']) }}
    </div>
</div>


<div class="form-group">
    {!!Form::label('nombre','Fecha devolución:',['class'=>"col-sm-6"])!!}
	<div class="col-md-12">
	    {!!Form::text('f_devolucion',null,['class'=>'form-control','id'=>'fecha' ,'required'])!!}
	 </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4"/>
                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>



<input type="hidden" name="tool_id" value="{{$tool->id}}">