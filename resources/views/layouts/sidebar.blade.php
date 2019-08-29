  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset("/bower_components/AdminLTE/dist/img/user2-160x160.jpg") }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENÚ</li>
        @if(Auth::user()->tipo == 'Admin')
        <li class="treeview {{ ! Route::is('user.index')  ?: 'active'  }}">
          <a href="#">
            <i class="fa fa-users"></i> <span>Usuarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/user/create"><i class="fa fa-circle-o"></i> Agregar</a></li>
            <li><a href="/user/"><i class="fa fa-circle-o"></i> Listar</a></li>
          </ul>
        </li>
        <li><a href="/category"><i class="fa fa-dashboard"></i> <span>Categorías</span></a></li>
        </li>
        @endif


        <li class="treeview {{ ! Route::is('tools.index')  ?: 'active'  }}" >
          <a href="#">
            <i class="fa fa-gavel" ></i> <span>Herramientas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(Auth::user()->tipo == 'Admin')
            <li><a href="/tool/create"><i class="fa fa-circle-o"></i> Agregar</a></li>
            @endif
            <li><a href="/tool/"><i class="fa fa-circle-o"></i> Listar</a></li>
          </ul>
        </li>
        
        <li class="treeview {{ ! Route::is('petitions.show')  ?: 'active'  }}">
          <a href="#">
            <i class="fa fa-tasks"></i> <span>Solicitudes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if(Auth::user()->tipo == 'Admin')
            <li><a href="/petition/"><i class="fa fa-circle-o"></i> Nuevas</a></li>
            <li><a href="/aprobadas/"><i class="fa fa-circle-o"></i> Aprobadas</a></li>
            <li><a href="/revisar/"><i class="fa fa-circle-o"></i> A revisar</a></li>
            <li><a href="/finalizadas/"><i class="fa fa-circle-o"></i> Finalizadas</a></li>
            <li><a href="/rechazadas/"><i class="fa fa-circle-o"></i> Rechazadas</a></li>
            @else
            <li><a href="/mispeticiones/"><i class="fa fa-circle-o"></i> Mis Solicitudes</a></li>
            @endif

            
          </ul>
        </li>
        
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>