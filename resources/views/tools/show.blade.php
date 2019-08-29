@extends('tools.base')
@section('action-content')

    <!-- Main content -->
    <section class="content">
    @include('alerts.success')
    @include('alerts.errors')
      <div class="box">
 
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>

    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">

        <div class="col-sm-4">
            <img src="{{$tool->imagen}}" class="img-responsive" width="300" height="300" ></img>
            
        </div>

        <div class="col-sm-8">
        <table class="table table-bordered">
        <tr>
          <th>Elemento:</th>
          <td>{{$tool->nombre}}</td>
        </tr>
        <tr>
          <th>Cantidad disponible:</th>
          <td>{{$tool->cantidad_disponible}}</td>
        <tr>
          <th>Categoría:</th>
          <td>{{$tool->category->nombre}}</td>
        </tr>
        @if($tool->subcategory_id != '')
        <tr>
          <th>Subcatgoría:</th>
          <td>{{App\Subcategory::find($tool->subcategory_id)->nombre}}</td>
        </tr>
        @endif

        <tr>
          <th>Descripción:</th>
          <td>{{$tool->descripcion}}</td>
        </tr>
        
      </table>
      @if(Auth::user()->tipo != "Admin")
      <a href="{{ route('cart-add', ['id' => $tool->id]) }}" class="btn btn-success btn-md margin" data-toggle="tooltip" data-placement="top" title="Lo necesito">
                        <i class="fa fa-cart-plus fa-lg"></i>
                        </a>
      @endif
        </div>
  </div>
  <!-- /.box-body -->
</div>
</div>
    </section>
    <!-- /.content -->
  
@endsection