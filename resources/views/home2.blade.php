@extends('layouts.admin2')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="card p-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <span class="h4 d-block font-weight-normal mb-2">{{$users_count}}</span>
                        <span class="font-weight-light">Total Usuarios</span>
                    </div>

                    <div class="h2 text-muted">
                        <i class="fa fa-users fa-fw"></i>
                    </div>
                </div>
            </div>
        </div>
 
        <div class="col-md-3">
            <div class="card p-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <span class="h4 d-block font-weight-normal mb-2">{{$tools_count}}</span>
                        <span class="font-weight-light">Total Elementos</span>
                    </div>

                    <div class="h2 text-muted">
                        <i class="icon icon-puzzle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <span class="h4 d-block font-weight-normal mb-2">
                            @php ($cont_espera = 0)
                            @php ($cont_f_entrega_hoy = 0)
                            @foreach($tools as $tool)
                                @foreach($tool->users as $user)
                                        @if($user->pivot->aprobada == "En espera")
                                           @php ($cont_espera = $loop->iteration)
                                            
                                        @endif

                                        @if(Carbon\Carbon::parse($user->pivot->f_devolucion)->format('Y-m-d') == Carbon\Carbon::now()->format('Y-m-d') && $user->pivot->aprobada == "Aprobada")
                                            
                                        @php ($cont_f_entrega_hoy = $loop->iteration)
                                        @endif
                                @endforeach
                            @endforeach
                            {{ $cont_espera }}
                        </span>
                        <span class="font-weight-light">Solicitudes en espera</span>
                    </div>

                    <div class="h2 text-muted">
                        <i class="icon icon-puzzle"></i>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-3">
            <div class="card p-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <span class="h4 d-block font-weight-normal mb-2">
                          
                            {{ $cont_f_entrega_hoy }}
                        </span>
                        <span class="font-weight-light">Elementos para hoy</span>
                    </div>

                    <div class="h2 text-muted">
                        <i class="icon icon-puzzle"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>


</div>

@endsection