@extends('layouts.admin2')
    @section('content')
		@include('alerts.request')
		<div class="row">
        <div class="col-md-6 col-md-offset-3 offset-3">
            <div class="card">
                <div class="card-header bg-light">
                            Nuevo elemento
                </div>
                <div class="card-body">

		{!!Form::open(['route'=>'tool.store', 'method'=>'POST', 'files' => true , 'class' =>'form-horizontal'])!!}            
            @include('tools.form')
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
@stop
