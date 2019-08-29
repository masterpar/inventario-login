
    <div class="card">
        <div class="card-header bg-light">
            Subategorías de {{strtoupper($category->nombre)}}
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
                    @foreach($subcategories as $subcategory)
                    <tbody>
                   		<td>{{$subcategory->nombre}}</td>
                        <td>
                        {!!Form::open(['route'=>['subcategory.destroy', $category->id , $subcategory->id],'method'=>'delete'])!!}                       
                        {!!link_to_route('subcategory.edit', $title = 'Editar', $parameters = [$category->id,$subcategory->id], $attributes = ['class'=>'btn btn-primary'])!!}                        
                        {!!Form::submit('Eliminar',['class'=>'btn btn-danger'])!!}
                        {!!Form::close()!!}
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>