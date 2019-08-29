@extends('categories.base')

@section('action-content')

	<div class="row">

    <div class="col-md-12">
					<div class="card">
                        <div class="card-header bg-light">
                            <p>Petición</p>
                        </div>
                        <div class="card-body">
                @if(count($cart)) 	
                <p>
                <a href="{{ route('cart-trash') }}" class="btn btn-danger">
                    Vaciar carrito <i class="fa fa-trash"></i>
                </a>
                </p>
                <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Imagen</th>
                            <th>Elemento</th>
                            <th>Cantidad</th>
                            <th>Quitar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                            <tr> 
                                <td><img src="{{ $item->imagen }}" width="100" height="100"/></td>
                                <td>{{ $item->nombre }}</td>
                                <td>
                                    <input 
                                        type="number"
                                        min="1"
                                        max="100"
                                        value="{{ $item->cantidad }}"
                                        id="product_{{ $item->id }}"
                                    >
                                    <a 
                                        href="#" 
                                        class="btn btn-warning btn-update-item btn-rounded "
                                        data-href="{{ route('cart-update',$item->id ) }}"
                                        data-id = "{{ $item->id }}"
                                    >
                                        <i class="fa fa-play"></i>
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
                </table><hr>
                @else
                <h3><span class="label label-warning">No hay productos en el carrito :(</span></h3>
                @endif

                <hr>
            <p>
                <a href="{{route('tool.index')}}" class="btn btn-primary">
                    <i class="fa fa-chevron-circle-left"></i> Agregar más
                </a>

                <a href="{{route('petition.create')}}" class="btn btn-primary">
                 Continuar <i class="fa fa-chevron-circle-right"></i>
                </a>
            </p>


                        </div>
                    </div>
				</div>


	</div>
@endsection