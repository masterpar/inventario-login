@extends('users.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
    @include('alerts.success')
    @include('alerts.errors')
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">Elementos solicitados</h3>
        </div>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>

    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">

        <div class="col-sm-12">

        <div class="table-responsive">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="User: activate to sort column ascending">Imagen</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Elemento</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Cantidad disponible</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Cantidad a pedir</th>
                <th width="10%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Quitar</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($cart as $item)
                <tr role="row" class="odd">
                  <td><img src="{{ $item->imagen }}" width="60" height="60"/></td>
                      <td>{{ $item->nombre }}</td>
                      <td>{{ \App\Tool::find($item->id)->cantidad_disponible }}</td>
                      <td>
                          <input 
                              type="number"
                              min="1"
                              max="{{ $item->cantidad_disponible }}"
                              value="{{ $item->cantidad }}"
                              id="product_{{ $item->id }}"
                              class="number"
                              required 
                          >
                          <a 
                              href="#" 
                              class="btn btn-warning btn-update-item btn-rounded "
                              data-href="{{ route('cart-update',$item->id ) }}"
                              data-id = "{{ $item->id }}"
                          >
                              <i class="fa fa-refresh"></i>
                          </a>
                      </td>
                      <td>
                         <a href="{{ route('cart-delete', $item->id) }}" class="btn btn-danger btn-rounded ">
                              <i class="fa fa-trash"></i>
                          </a>
                      </td>
              </tr>
            @endforeach
            </tbody>
          </table>

          <hr>
            <p>
               <a href="/cart/trash" class="btn btn-danger btn-rounded">
                              <i class="fa fa-trash-o"></i> Vaciar 
                          </a>
                <a href="{{route('tool.index')}}" class="btn btn-primary">
                    <i class="fa fa-chevron-circle-left"></i> Agregar más
                </a>

                <a href="{{route('petition.create')}}" class="btn btn-primary">
                 Continuar <i class="fa fa-chevron-circle-right"></i>
                </a>
            </p


          
          </div>
        </div>
      </div>
    
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>
@endsection