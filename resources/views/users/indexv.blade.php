@extends('layouts.admin2')
	@section('content')
	@include('alerts.request')
			<div class="row">
				<div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-light">
                            Lista de usuarios
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
										<th>Correo</th>
										<th>Tipo usuario</th>
										<th>Operacion</th>
                                    </tr>
                                    </thead>
                                    @foreach($users as $user)
                                    <tbody>
                                   		<td>{{$user->name}}</td>
										<td>{{$user->email}}</td>
										<td>{{$user->tipo}}</td>
										<td>{!!link_to_route('user.edit', $title = 'Editar', $parameters = $user->id, $attributes = ['class'=>'btn btn-primary'])!!}</td>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                @if(count($users))
                        {{$users->links('pagination::bootstrap-4') }}
                @endif
   
                </div>

            </div>



@endsection