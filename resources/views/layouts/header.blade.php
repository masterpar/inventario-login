  <!-- Main Header -->
  <header class="main-header" >

    <!-- Logo -->
    <a href="/home" class="logo" style="background: #222d32;"  >
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini" ><b>C</b>I</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img  src="{{ asset("/img/ceind3.png")}}"  class="img-responsive"/></span>
    </a>
    
    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         
         @if(Auth::user()->tipo != "Admin")
         <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <i class="fa fa-cart-plus"></i>
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header" style="background-color: white;">
                   
                @php ($cart = \Session::get('cart') )                   
                @if(empty(!$cart))
                <div id="Layer1" style="width:auto; height:150px; overflow: auto;">
                <table class="table table-bordered" style="background-color: white;">                 
                        <tr>
                            <th>Elemento</th>
                            <th>Imagen</th>
                            <th>Cantidad</th>
                        </tr>
                        <tbody>
                        @foreach($cart as $item)
                            <tr>
                                <td>{{ $item->nombre }}</td>
                                <td><img src="{{ $item->imagen }}" width="40" height="40"/></td>
                                <td>{{ $item->cantidad }}</td>
                            </tr>
                        @endforeach
                      </tbody>
                              </table>
                            </div>
                @else
                    <div class="col-md-12">
                      <h3>No hay elementos.</h3>
                     </div>
                @endif

              </li>
              <!-- Menu Footer-->
              <li class="user-footer">               
                 <div class="pull-right">
                    <a class="btn btn-default btn-flat" href="{{ route('cart-show') }}">
                    Ver elementos
                    </a>
                 </div>
              
              </li>
            </ul>
          </li>
        @endif
        






          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->username }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">

                <p>
                  Hola {{ Auth::user()->username }}
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
               @if (Auth::guest())
                  <div class="pull-left">
                    <a href="{{ route('login') }}" class="btn btn-default btn-flat">Login</a>
                  </div>
               @else
                 <div class="pull-left">
                    <a href="{{ url('profile') }}" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                 <div class="pull-right">
                    <a class="btn btn-default btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    Salir
                    </a>
                 </div>
                @endif
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
   <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
   </form>