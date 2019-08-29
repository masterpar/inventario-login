@extends('layouts.admin2')
    @section('content')
		@include('alerts.request')
		<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                            Nuevo petición
                </div>
                <div class="card-body">

		{!!Form::open(['route'=>'petitions.store', 'method'=>'POST' , 'class' =>'form-horizontal'])!!}            
            @include('petitions.form')
	      <div class="form-group">
	     
          <a href="{{ route('cart-show') }}" class="btn btn-primary">
            <i class="fa fa-chevron-circle-left"></i> Regresar
          </a>
	      	{!!Form::submit('Guardar',['class'=>'btn btn-info'])!!}

	    </div>    
		
		{!!Form::close()!!}    

    </div>
            </div>
        </div>
    </div>
@stop
