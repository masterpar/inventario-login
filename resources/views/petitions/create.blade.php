@extends('petitions.base')

@section('action-content')
<section class="content">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nueva Solicitud</div>
                <div class="panel-body">
                    {!!Form::open(['route'=>'petition.store', 'method'=>'POST' , 'class' =>'form-horizontal'])!!} 

                    @include('petitions.form')       
                       

                         <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!!Form::submit('Guardar',['class'=>'btn btn-primary col-md-12', 'id' => 'boton'])!!}
                            </div>
                        </div>
                    {!!Form::close()!!} 

                    <a href="{{ route('cart-show') }}" class="btn btn-primary">
            <i class="fa fa-chevron-circle-left"></i> Regresar
          </a>

                </div>


            </div>
        </div>
    </div>
</div>
</section>
@endsection
