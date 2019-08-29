@extends('layouts.admin2')

	@section('content')
	@include('alerts.request')
			<div class="row">
				
				@if(!$categories->isEmpty())
				<div class="col-md-6">

                @include('categories.list')

                @if(count($categories))
                        {{$categories->links('pagination::bootstrap-4') }}
                @endif
   
                </div>

                @endif


                <div class="col-md-6">
					<div class="card">
                        <div class="card-header bg-light">
                            Nueva categoría
                        </div>
                        <div class="card-body">
                        	<div class="form-group">
								{!!Form::open(['route'=>'category.store', 'method'=>'POST', 'class' =>'form-inline'])!!}
                                   
		        					     <div class="form-group col-md-8">
		                  			
		                    	@include('categories.form')
                                    
		                    	</div>
		                    		
		                    	{!!Form::submit('Guardar',['class'=>'btn btn-info'])!!}
		                    		
		                    		
		                    	{!!Form::close()!!}  

                  			</div>
                  	                  
                
                        </div>
                    </div>
				</div>

            </div>



@endsection