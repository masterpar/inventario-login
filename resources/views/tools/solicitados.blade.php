@extends('layouts.admin2')

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
                                    	<th>Elemento</th>
                                    	<th>Fecha solicitud</th>
                                    	<th>Fecha devolución</th>
                                        <th>Estado</th>
                                        <th>Operacion</th>
                                        
									
                                    </tr>
                                    </thead>
                                    @foreach($tools as $tool)

                                    <tbody>
                                
                                   		<td>{{$tool->nombre}}</td>
										<td>{{$tool->pivot->created_at}}</td>
										<td>{{$tool->pivot->f_devolucion}}</td>
                                        <td>{{$tool->pivot->aprobada}}</td>
                                        <td>
                                        {!!link_to_route('tool.observacion', $title = 'Observaciones', $parameters = [$tool->id,$tool->pivot->id], $attributes = ['class'=>'btn btn-success'])!!}
                                        
                                        {!!Form::open(['route'=>'tool.entregar', 'method'=>'POST', 'class' =>'form-inline'])!!}
                                            <input type="hidden" name="tool_id" value="{{$tool->id}}">
                                            <input type="hidden" name="id" value="{{$tool->pivot->id}}">
                                            <input type="hidden" name="created_at" value="{{$tool->pivot->created_at}}">
                                        {!!Form::submit('Entregar',['class'=>'btn btn-info'])!!}
                                        {!!Form::close()!!}
                                        </td>
                                    </tbody>
                                   
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