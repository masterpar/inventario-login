@extends('layouts.admin2')

@section('content')
<div class="row">
<div class="col-md-12">
	<div class="card">
	    <div class="card-header bg-light">
	        Filtrar
	    </div>
	    <div class="card-body">
	    	<div class="form-group">

  				{!!Form::open(['route'=>'tool.index', 'method'=>'get' ,'class' => 'form-inline float-right','role' => 'search'])!!}
					<div class="form-group ">
					{!!Form::text('nombre',null,['class'=>'form-control'])!!}
					</div>
	  				{!!Form::submit('Buscar',['class'=>'btn btn-primary'])!!}
        
    			{!!Form::close()!!}
			
			</div>
		                  
	    </div>
	</div>
</div>
</div>

@include('tools.list')

@endsection