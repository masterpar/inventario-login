@extends('layouts.admin2')
	@section('content')
	@include('alerts.request')

	<div class="row">

    <div class="col-md-6 col-md-offset-3 offset-3">
					<div class="card">
                        <div class="card-header bg-light">
                            Observación para el elemento
                        </div>
                        <div class="card-body">
	                        	<div class="form-group">
									{!!Form::open(['route'=>'tool.guardar_observacion', 'method'=>'PUT', 'class' =>'form-horizontal'])!!} 
				          			
				                        
											<div class="form-group">
													<div class="col-md-12">
	  												{!!Form::label('elemento','Elemento: ')!!}
	  														<p class="form-control">{{$tool->nombre}}</p>
	  												</div>
											</div>

											<div class="form-group">
	    												<div class="col-md-12">
	      												{!!Form::label('observacion','Observación:')!!}
	      												{{ Form::textarea('observacion', $x->pivot->observacion, ['size' => '30x5', 'class'=>'form-control','required']) }}
	    												</div>
											</div>

											<input type="hidden" name="tool_id" value="{{$tool->id}}">
											<input type="hidden" name="id" value="{{$x->pivot->id}}">
				                        	<div class="form-group">
								      						<div class="col-sm-6">
								      					{!!Form::submit('Guardar',['class'=>'btn btn-info'])!!}
								      						</div>
								    		</div>    
									
									{!!Form::close()!!} 

	                  			</div>
                  	                  
                
                        </div>
                    </div>
				</div>


	</div>
@endsection