@extends('layouts.admin2')
	@section('content')
    @include('alerts.request')
    @include('alerts.success')
    @include('alerts.errors')
	
			<div class="row">
				
                @if(!$subcategories->isEmpty())

				<div class="col-md-6">
                
                @include('subcategories.list')

                @if(count($subcategories))
                        {{$subcategories->links('pagination::bootstrap-4') }}
                @endif
   
                </div>

                @endif

                <div class="col-md-6">
					<div class="card">
                        <div class="card-header bg-light">
                            Nueva subcategoría
                        </div>
                        <div class="card-body">
                        	<div class="form-group">
                        		

                {!!Form::open(['route'=>['subcategory.store', $category->id],'method'=>'POST','class' =>'form-inline'])!!}
                                   
		        					     <div class="form-group col-md-8">
		                  			
		                    	@include('subcategories.form')
                                    
		                    	</div>
		                    		
		                    	{!!Form::submit('Guardar',['class'=>'btn btn-info'])!!}
		                    		
		                    		
		                    	{!!Form::close()!!}  

                  			</div>
                  	                  
                
                        </div>
                    </div>
				</div>

            </div>



@endsection