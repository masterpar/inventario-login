@extends('tools.base')
@section('action-content')


<!-- Main content -->
    <section class="content">
      <div class="row">


        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
           <br>       
              {!!Form::open(['route'=>'tool.index', 'method'=>'get' ,'class' => 'form-inline float-right','role' => 'search'])!!}
               <div class="input-group input-group-sm col-md-4" style=" margin-left: 5px;">
                 {!!Form::select('category_id', $categories , null , ['class'=>'form-control'  , 'id' => 'categ' , 'placeholder'=>'Seleccione categoría'])!!}
               </div>
              <div class="input-group input-group-sm col-md-4">                
                <input type="text" name="nombre" class="form-control" >
                    <span class="input-group-btn">                    
                      {!!Form::submit('Buscar',['class'=>'btn btn-info btn-flat'])!!}
                    </span>
              </div>
          {!!Form::close()!!}
              <br>
          </div>
          <!-- /.box -->

  </div>
</div>

  
	<div class="row" id="ads">
      @foreach ($tools as $tool)
          <!-- Category Card -->
          <div class="col-md-3">
                <div class="card rounded m-5">
                    <div class="card-image">
                        <img class="img-fluid " src="{{$tool->imagen}}" width="90" height="90" alt="Alternate Text" />
                    </div>
                    <div class="card-image-overlay m-auto text-center">
                        <span class="card-detail-badge">Disponibles: <strong> {{$tool->cantidad_disponible}} </strong></span>
                    </div>
                    <div class="card-body text-center">            
                        <div class="ad-title m-auto">
                            <h5 >{{$tool->nombre}} </h5>
                        </div>
                        <a class="ad-btn-ver" href="{{ route('tool.show', ['id' => $tool->id]) }}"  data-toggle="tooltip" data-placement="top" title="Ver más">
                                <i class="fa fa-eye fa-lg"></i>
                                </a> 
                        <a class="ad-btn-necesito" href="{{ route('cart-add', ['id' => $tool->id]) }}"  data-toggle="tooltip" data-placement="top" title="Lo necesito">
                                <i class="fa fa-cart-plus fa-lg"></i>
                                </a>
                     </div>
                </div>
           </div>
        @endforeach
  </div>
</div> 

    </section>




@endsection