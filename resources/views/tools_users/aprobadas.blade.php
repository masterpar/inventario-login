
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
				
				<div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Lista de solicitudes
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                    	<th>Usuario</th>
                                    	<th>Elemento</th>
                                    	<th>Fecha solicitud</th>
                                    	<th>Fecha devolución</th>
                                        <th>Estado</th>
                                        <th>Operacion</th>
									
                                    </tr>
                                    </thead>
                                    @foreach($tools as $tool)

                                    <tbody>
                                    @foreach($tool->users as $user)
                                        @if($user->pivot->aprobada == "Aprobada" || $user->pivot->aprobada == "Entregado")
                                   		<td>{{$user->name}}</td>
                                   		<td>{{$tool->nombre}}</td>
										<td>{{$user->pivot->created_at}}</td>
										<td>{{$user->pivot->f_devolucion}}</td>
                                        <td>{{$user->pivot->aprobada}}</td>
                                        <td>


                                     @if($user->pivot->aprobada == "Aprobada")

                                        {!!link_to_route('tool.index', $title = 'Expandir', $parameters = $user->pivot->id, $attributes = ['class'=>'btn btn-primary'])!!}
                                    @endif 

                                    @if($user->pivot->aprobada == "Entregado")

                                        {!!Form::open(['route'=>'tool.finalizar', 'method'=>'POST', 'class' =>'form-inline'])!!}
                                            <input type="hidden" name="tool_id" value="{{$tool->id}}">
                                            <input type="hidden" name="id" value="{{$user->pivot->id}}">
                                            <input type="hidden" name="created_at" value="{{$user->pivot->created_at}}">
                                        {!!Form::submit('Finalizar',['class'=>'btn btn-success'])!!}
                                        {!!Form::close()!!}
                                    @endif 



                                        
                                        </td>
                                        @endif
                                    </tbody>
                   
                    
                                    @endforeach
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                @if(count($tools))
                        {{$tools->links('pagination::bootstrap-4') }}
                @endif
   
                </div>


            </div>



@endsection