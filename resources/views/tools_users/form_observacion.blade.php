
<div class="form-group">
<div class="col-md-12">
  {!!Form::label('elemento','Elemento: ')!!}
  <p class="form-control">{{$tool->nombre}}</p>
  </div>
</div>

<div class="form-group">
    <div class="col-md-12">
      {!!Form::label('observacion','Observación:')!!}
      {{ Form::textarea('observacion', null, ['size' => '30x5', 'class'=>'form-control','required']) }}
    </div>
</div>

<input type="hidden" name="tool_id" value="{{$tool->id}}">


