<div class="card-footer bg-light">
          @if($tool->disponible == 'Sí')
                {!!Form::open(['route'=>'tool.guardar_solicitud', 'method'=>'POST', 'class' =>'form-horizontal'])!!} 
                    <div class="form-group">        
                        @include('tools_users.form')
                        {!!Form::submit('Solicitar',['class'=>'btn btn-success'])!!}
                    </div>
                {!!Form::close()!!}
              @else
                @if(!Auth::user()->tools()->find($tool->id) == null)
                  {!!Form::open(['route'=>['tool.entregar', $tool->id],'method'=>'post'])!!}
                  <input type="hidden" name="tool_id" value="{{$tool->id}}">
                  {!!Form::submit('Entregar',['class'=>'btn btn-success'])!!}
                  {!!Form::close()!!}  
                @endif
          @endif
        </div>