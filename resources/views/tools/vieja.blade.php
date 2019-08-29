@extends('layouts.admin2')
	@section('content')
	@include('alerts.request')

	<div class="row">

    <div class="col-md-6 col-md-offset-3 offset-3">
					<div class="card">
                        <div class="card-header bg-light">
                            Nueva solicitud
                        </div>
                        <div class="card-body">
                        	<div class="form-group">
								{!!Form::open(['route'=>'tool.guardar_solicitud', 'method'=>'POST', 'class' =>'form-horizontal'])!!} 
			                          
			                        @include('tools_users.form')
			                        <div class="form-group">
							      <div class="col-sm-6">
							      	{!!Form::submit('Enviar',['class'=>'btn btn-info'])!!}
							      </div>
							    </div>    
								
								{!!Form::close()!!} 

                  			</div>
                  	                  
                
                        </div>
                    </div>
				</div>


	</div>
@endsection