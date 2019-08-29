
    <div class="card">
        <div class="card-header bg-light">
            Lista de categorías
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                    	<th>Nombre</th>
    					<th>Operacion</th>
                    </tr>
                    </thead>
                    @foreach($categories as $category)
                    <tbody>
                   		<td>{{$category->nombre}}</td>
    					<td>
    					{!!Form::open(['route'=>['category.destroy', $category->id],'method'=>'delete'])!!}


    					{!!link_to_route('subcategory.index', $title = 'Ver', $parameters = $category->id, $attributes = ['class'=>'btn btn-success'])!!}
    					
    					{!!link_to_route('category.edit', $title = 'Editar', $parameters = $category->id, $attributes = ['class'=>'btn btn-primary'])!!}

    					
    						{!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
    					{!!Form::close()!!}
    					</td>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>