<div class="row">
  @forelse($tools as $tool)
  
  <div class="col-md-3">
    <div class="card">
        <div class="card-header bg-light">
            <strong>{{$tool->nombre}}</strong>
            @if(Auth::user()->tipo == 'Admin')
            <div class="card-actions">
                <a href="/tool/{{$tool->id}}/edit/" class="btn">
                  <i class="fa fa-pencil-alt"></i>
                </a>

                <a href="#" class="btn">
                    <i class="fa fa-cog"></i>
                </a>
            
            </div>
            @endif
        </div>

        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <img src={{$tool->imagen}} width="200" height="200"/>

              @if($tool->disponible == 'Sí')
              <br>
              <br>
                  {!!link_to_route('tool.show', $title = 'Solicitar', $parameters = $tool->id, $attributes = ['class'=>'btn btn-success'])!!}
                  
             @endif
            </div>

  

          </div>
          
        </div>
        
    </div>
  </div>
 
  @empty
  <div class="col-md-12">
    <h3>No hay elementos.</h3>
  </div>

  @endforelse
</div>