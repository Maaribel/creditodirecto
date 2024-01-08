<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="icon" href="{{ asset('img/favi.svg') }} ">

        <title>AGEmpresas - Credito Directo</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
        <!-- Styles -->
        
        <link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/icofont/icofont.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/remixicon/remixicon.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/venobox/venobox.css') }}" rel="stylesheet" >
        <link href="{{ asset('plugins/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/aos/aos.css') }}" rel="stylesheet" >
        <link href="{{ asset('plugins/styleindex.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/font.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/main.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/styleindex2.css') }}" rel="stylesheet"> 
        <link href="{{ asset('plugins/fontawesome-5.8.2/css/all.css') }}"  rel="stylesheet"> 
        <link href="{{ asset('plugins/jquery-chosen-1.8.7/chosen.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/jquery-confirm-3.3.4/css/jquery-confirm.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/DataTables-1.10.18/datatables.min.css') }}" rel="stylesheet">
        <link href="{{ asset('plugins/DataTables-1.10.18/buttons.dataTables.min.css') }}" rel="stylesheet" >  
    </head>
    
    <body id="admin_agc">
        <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home_admin') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @guest
                    @else

                    <?php
                            $arr = array();
                            foreach (Auth::user()->submenus as $key => $value){
                                $arr2 = array();
                                $arr2[] = ['nombre' => $value->SM_nombre,'ruta' => trim($value->SM_ruta)];
                                if(array_key_exists($value->menu->M_nombre, $arr)){
                                    $arr[$value->menu->M_nombre] = array_merge($arr[$value->menu->M_nombre],$arr2);
                                }else{
                                   $arr[$value->menu->M_nombre] = $arr2;
                                }        
                            }
                        ?>

                        <ul class="navbar-nav mr-auto">
                            @foreach($arr as $menu => $subMenus)
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ $menu }}</a>
                                <div class="dropdown-menu">
                                @foreach($subMenus as $op)
                                    <a class="dropdown-item" href="{{ route($op['ruta']) }}">{{ $op['nombre'] }}
                                    </a>
                                @endforeach
                                </div>
                                </li>
                            @endforeach
                        </ul>
                        
                    @endguest
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesion') }}</a>
                            </li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->U_nombres . ' ' . Auth::user()->U_apellidos }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->U_cambiar_contrasena == 1)
                                        <div class="alert alert-warning" role="alert">
                                            <a class="dropdown-item" href="{{ route('cambiar_mi_contrasena') }}">
                                                {{ __('Cambiar Clave') }}
                                            </a>
                                        </div>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Salir') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content_admin')
        </main>
    </div>
        
        
        <script src="{{ asset('plugins/jquery-3.4.0/jquery-3.4.0.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('plugins/jquery.easing/jquery.easing.min.js') }}"></script>
        <script src="{{ asset('plugins/php-email-form/validate.js') }}"></script>
        <script src="{{ asset('plugins/waypoints/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('plugins/counterup/counterup.min.js') }}"></script>
        <script src="{{ asset('plugins/venobox/venobox.min.js') }}"></script>
        <script src="{{ asset('plugins/charts/Chart.js') }} "></script>
        <script src="{{ asset('plugins/charts/Chart.min.js') }} "></script>
        <script src="{{ asset('plugins/owl.carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('plugins/isotope-layout/isotope.pkgd.min.js') }}"></script>
        <script src="{{ asset('plugins/aos/aos.js') }}"></script>
        <script src="{{ asset('plugins/js/main.js') }}"></script>
        <script src="{{ asset('plugins/sweetalert2.js') }}"></script>
        <script src="{{ asset('plugins/fontawesome-5.8.2/js/all.js') }}"></script>
        <script src="{{ asset('plugins/jquery-chosen-1.8.7/chosen.jquery.js') }}"></script>
        <script src="{{ asset('plugins/jquery-confirm-3.3.4/js/jquery-confirm.js') }}"></script>
        <script src="{{ asset('plugins/DataTables-1.10.18/datatables.js') }}"></script>
        <script src="{{ asset('plugins/DataTables-1.10.18/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/DataTables-1.10.18/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/DataTables-1.10.18/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/DataTables-1.10.18/buttons.colVis.min.js') }}"></script>
        <script src="{{ asset('js/creditodirecto.js') }}"></script>


    </body>
</html>