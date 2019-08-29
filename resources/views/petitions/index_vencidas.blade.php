@extends('petitions.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
    <div class="box-header">
              <h3 class="box-title">Solicitudes vencidas</h3>
            </div>
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>

    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Solicitud</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Usuario</th>
                <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Fecha solicitud</th>
                 <th width="20%" class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Fecha devolución estimada</th>
                <th tabindex="0" aria-controls="example2" rowspan="1" colspan="2" aria-label="Action: activate to sort column ascending">Acción</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($petitions as $petition)
                <tr role="row" class="odd">
                  <td>{{ $petition->nombre }}</td>
                  <td>{{ $petition->user->name }}</td>
                  <td>{{ $petition->created_at }}</td>
                  <td>{{ $petition->f_devolucion }}</td>
                  <td>
                    <form class="row" method="POST" action="{{ route('petition.destroy', ['id' => $petition->id]) }}" onsubmit = "return confirm('Está seguro que desea eliminar la solicitud?')">
        
                        <a href="{{ route('petition.show', ['id' => $petition->id]) }}" class="btn btn-success btn-md margin" data-toggle="tooltip" data-placement="top" title="Ver solicitud">
                        <i class="fa fa-eye fa-lg"></i>
                        </a>


                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     

                        <button type="submit" class="btn  btn-danger btn-md " ata-toggle="tooltip" data-placement="top" title="Eliminar solicitud">
                          <i class="fa fa-trash fa-lg"></i>
                        </button>
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
            {{ $petitions->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>


    </section>
    <!-- /.content -->
  
@endsection