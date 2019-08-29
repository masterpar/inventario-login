
@extends('layouts.admin2')
<?php $message=Session::get('message')?>

@if($message == 'store')
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  Usuario creado exitosamente
</div>
@endif
	@section('content')
	
			<div class="row">
				
				<div class="col-md-6">

                @include('categories.list')

                @if(count($categories))
                        {{$categories->links('pagination::bootstrap-4') }}
                @endif
   
                </div>

                <div class="col-md-6">
					<div class="card">
                        <div class="card-header bg-light">
                            Editar categoría
                        </div>
                        <div class="card-body">
                        	<div class="form-group">
                        		@include('alerts.request')
								{!!Form::model( $category, ['route'=>['category.update', $category->id],'method'=>'PUT', 'class' =>'form-inline'])!!}
                                     
		        					<div class="form-group col-md-8">
		                  			
		                    		@include('categories.form')
                                    
		                    		</div>
		                    		
		                    		{!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
		                    		
		                    		
		                    	{!!Form::close()!!}  

                  			</div>
                  	                  
                
                        </div>
                    </div>
				</div>

            </div>



@endsection