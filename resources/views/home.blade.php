@extends('layouts.admin')
@section('content')
<link href="{{ asset('css/estilotabla.css') }}" rel="stylesheet">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--<section class="content-header">
      <h1>
        Department Mangement
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> System Mangement</a></li>
        <li class="active">Department</li>
      </ol>
    </section>
    -->
    <section class="content">
    <div class="row">

      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$users_count}}</h3>
              <p>Total Usuarios</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="/user" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>

      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$vencidas}}</h3>
              <p>Solicitudes vencidas</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="/vencidas" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>

      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$petition_count}}</h3>
              <p>Solicitudes en espera</p>
            </div>
            <div class="icon">
              <i class="ion ion-load-a"></i>
            </div>
            <a href="/petition" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>


      <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3>{{$petition_revisar_count}}</h3>

              <p>Solicitudes a revisar</p>
            </div>
            <div class="icon">
              <i class="ion ion-eye"></i>
            </div>
            <a href="{{url('/revisar')}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
          </div>
      </div>



    </div>
  
 
      <div class="box">
      <div class="table-wrapper">
          <form action="" method="post">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                    <h2>SOLICITUDES NUEVAS</h2>
                         </div>
                         <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
                            <div class="col-sm-6">            
                        </div>
                </div>
            </div>
            <div class="table table-responsive" id="tabla_respuesta">             
               <table id="tablaprueba" class="table table-striped table-hover">
                  <thead>
                      <tr>
                      <th>Solicitud</th>
                      <th >Usuario</th>
                      <th >NIT/CC</th>
                      <th >Fecha solicitud</th>
                      <th >Fecha devolución estimada</th>
                      <th >Ver</th>
                      </tr>
                  </thead>
                  <tbody>

                   @foreach ($petitions as $petition)
                    <tr>
                   <td width="30%">{{ $petition->nombre }}</td>
                  <td>{{ $petition->user->name }}</td>
                  <td>{{ $petition->user->cc }}</td>
                  <td>{{ $petition->created_at }}</td>
                  <td>{{ $petition->f_devolucion }}</td>
                  <td>
                    
                         <div> <a type="button" class="btn btn-default ver  sinborde" href="{{ route('petition.show', ['id' => $petition->id]) }}">
                        <span class="glyphicon glyphicon-eye-open fa-lg" style="color: green;" ></span>
                      </a>
                        
                    </div>
                  </td>
                  </tr>
                   @endforeach

                  </tbody>
              </table>  
              <div class="clearfix">
                
                    {{ $petitions->links() }}
                </ul>
            </div>          
            </div>
            </form>
        </div>
</div>
</section>

    <!-- /.content -->
  </div>
@endsection