@extends('layouts.admin2')
    @section('content')
    @include('alerts.request')
    
    <div class="row">
        <div class="col-md-6 col-md-offset-3 offset-3">
            <div class="card">
                <div class="card-header bg-light">
                            Nuevo usuario
                </div>
                <div class="card-body">
    {!!Form::open(['route'=>'user.store', 'method'=>'POST'])!!}
    @include('users.form')

	<div class="form-group">
        <div class="col-md-6 col-md-offset-4">
             {!!Form::submit('Registrar',['class'=>'btn btn-primary'])!!}

        </div>
    </div>
                    
    {!!Form::close()!!}
                </div>
            </div>
        </div>
    </div>
@stop
