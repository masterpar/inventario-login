@extends('layouts.admin')
    @section('content')
            <br>
            
		@include('alerts.request')
		{!!Form::open(['route'=>'tool.guardar_solicitud', 'method'=>'POST', 'class' =>'form-horizontal'])!!}            
            @include('tools_users.form')
	      <div class="form-group">
	      <div class="col-sm-6">
	      	{!!Form::submit('Guardar',['class'=>'btn btn-info'])!!}
	      </div>
	    </div>    
		
		{!!Form::close()!!}    

     @stop

