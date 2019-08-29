<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ceindetec - Inventario</title>
    {!!Html::style('vendor/simple-line-icons/css/simple-line-icons.css')!!}
    {!!Html::style('vendor/font-awesome/css/fontawesome-all.min.css')!!}
    {!!Html::style('css/styles.css')!!}
    {!!Html::style('css/tempusdominus-bootstrap-4.min.css')!!}
</head>
<body class="sidebar-fixed header-fixed">
<div class="page-wrapper">
    <nav class="navbar page-header">
        <a href="#" class="btn btn-link sidebar-mobile-toggle d-md-none mr-auto">
            <i class="fa fa-bars"></i>
        </a>

        <a class="navbar-brand" href="/home">
            <img  src="/img/ceind2.png " class="img-responsive" width="220" height="50" alt="logo"/>
        </a>

        <a href="#" class="btn btn-link sidebar-toggle d-md-down-none">
            <i class="fa fa-bars"></i>
        </a>

        <ul class="navbar-nav ml-auto">
        
            <li class="nav-item d-md-down-none">
                <a href="{{ route('cart-show') }}">
                    <i class="fa fa-bell"></i>
                </a>
            </li>

            <li class="nav-item d-md-down-none">
                <a href="#">
                    <i class="fa fa-envelope-open"></i>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="/imgs/avatar-1.png" class="avatar avatar-sm" alt="logo">
                    <span class="small ml-1 d-md-down-none">{!!Auth::user()->name!!}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header">Cuenta</div>

                    <a href="#" class="dropdown-item">
                        <i class="fa fa-user"></i> Perfil
                    </a>

                    <a href="#" class="dropdown-item">
                        <i class="fa fa-envelope"></i> Mensajes
                    </a>

                    <div class="dropdown-header">Configuraciones</div>

                    <a href="#" class="dropdown-item">
                        <i class="fa fa-bell"></i> Notificaciones
                    </a>

                    <a href="/logout" class="dropdown-item">
                        <i class="fa fa-lock"></i> Cerrar sesión
                    </a>
                </div>
            </li>
        </ul>
    </nav>

    <div class="main-container">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-title">Menú</li>
                    @if(Auth::user()->tipo == 'Admin')
                    <li class="nav-item">
                        <a href="/home" class="nav-link">
                            <i class="icon icon-speedometer"></i> Dashboard
                        </a>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="fa fa-users fa-fw"></i> Usuarios <i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="/user/create" class="nav-link">
                                    <i class="fa fa-plus fa-fw"></i> Agregar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/user/" class="nav-link">
                                    <i class="fa fa-list-ol fa-fw"></i> Listar
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a href="/category/" class="nav-link">
                            <i class="fa fa-circle"></i> Categorias
                        </a>
                    </li>

                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="icon icon-puzzle"></i> Elementos <i class="fa fa-caret-left"></i>
                        </a>
                        
                        <ul class="nav-dropdown-items">
                            @if(Auth::user()->tipo == 'Admin')
                            <li class="nav-item">
                                <a href="/tool/create" class="nav-link">
                                    <i class="fa fa-plus fa-fw"></i> Agregar
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a href="/tool/" class="nav-link">
                                    <i class="fa fa-list-ol fa-fw"></i> Listar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/solicitados" class="nav-link">
                                    <i class="fa fa-list-ol fa-fw"></i> Solicitados
                                </a>
                            </li>
                        </ul>
                    </li>

                    @if(Auth::user()->tipo == 'Admin')

                    <li class="nav-item nav-dropdown">
                        <a href="#" class="nav-link nav-dropdown-toggle">
                            <i class="fa fa-circle fa-fw"></i> Solicitudes <i class="fa fa-caret-left"></i>
                        </a>

                        <ul class="nav-dropdown-items">
                            <li class="nav-item">
                                <a href="/solicitudes/" class="nav-link">
                                    <i class="fa fa-plus fa-fw"></i> Nuevas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/solicitudes/aprobadas/" class="nav-link">
                                    <i class="fa fa-list-ol fa-fw"></i> Aprobadas
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    

                </ul>
            </nav>
        </div>

        <div class="content">
            @yield('content')
        </div>
    </div>
</div>
{!!Html::script('vendor/jquery/jquery.min.js')!!}

{!!Html::script('vendor/popper.js/popper.min.js')!!}
{!!Html::script('vendor/bootstrap/js/bootstrap.min.js')!!}
{!!Html::script('vendor/chart.js/chart.min.js')!!}
{!!Html::script('js/carbon.js')!!}
{!!Html::script('js/demo.js')!!}
{!!Html::script('js/mio.js')!!}
{!!Html::script('js/moment.js')!!}
{!!Html::script('js/moment-with-locales.js')!!}
{!!Html::script('js/tempusdominus-bootstrap-4.min.js')!!}

</body>
</html>
