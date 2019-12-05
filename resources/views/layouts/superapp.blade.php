<!doctype html>

<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Otogaraj') }}</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/animate-css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/flag-icon/css/flag-icon.min.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/data-tables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/vendors/data-tables/extensions/responsive/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/themes/vertical-dark-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/themes/vertical-dark-menu-template/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/custom/custom.css') }}">





    @yield('css')
</head>
<!-- END: Head-->


<?php 
    $ayarlar =\App\userAyar::where('user_id','=', Auth::user()->id)->get();
    $ayar = $ayarlar[0]->ayarJSON;
    $ayar = json_decode($ayar);
 ?>
<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu 2-columns  "
    data-open="click" data-menu="vertical-dark-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-light">
                <div class="nav-wrapper">
                    <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
                        <input class="header-search-input z-depth-2" type="text" name="Search"
                            placeholder="Kullanıcı Email Giriniz ">
                    </div>
                    <ul class="navbar-list right">
                        <li class="hide-on-large-only"><a class="waves-effect waves-block waves-light search-button"
                                href="javascript:void(0);"><i class="material-icons">search</i></a></li>
                       
                        <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="#"
                                data-target="slide-out-right"><i class="material-icons">format_indent_increase</i></a>
                        </li>
                    </ul>
                    <!-- translation-button-->

                    <!-- notifications-dropdown-->
                    
                    
                    
                </div>
                <nav class="display-none search-sm">
                    <div class="nav-wrapper">
                        <form>
                            <div class="input-field">
                                <input class="search-box-sm" type="search" required="">
                                <label class="label-icon" for="search"><i
                                        class="material-icons search-sm-icon">search</i></label><i
                                    class="material-icons search-sm-close">close</i>
                            </div>
                        </form>
                    </div>
                </nav>
            </nav>
        </div>
    </header>
    <!-- END: Header-->

    <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark sidenav-active-rounded">
        <div class="brand-sidebar">
            <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{asset('/')}}"><span
                        class="logo-text hide-on-med-and-down">{{ config('app.name', 'Otogaraj') }}</span></a><a
                    class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
            
        </div>
        <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
            data-menu="menu-navigation" data-collapsible="accordion">

            <li class="bold"><a class="waves-effect waves-cyan " href="{{asset('/home')}}"><i
                        class="material-icons">mail_outline</i><span class="menu-title" data-i18n="">Anasayfa</span></a>
            </li>
            @role('super-admin')
            <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i
                        class="material-icons">account_box</i><span class="menu-title" data-i18n="">Profil</span><span
                        class="badge badge pill orange float-right mr-10">2</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li><a class="collapsible-body" href="{{ route('users.index') }}" data-i18n=""><i
                                    class="material-icons">radio_button_unchecked</i><span>Profil</span></a>
                        </li>
                        <li><a class="collapsible-body" href="{{ route('roles.index') }}" data-i18n=""><i
                                    class="material-icons">radio_button_unchecked</i><span>Roller</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li><a class="collapsible-body" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                    class="material-icons">lock_outline</i> {{ __('Çıkış Yap') }}</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

            </li>

            
            
            @endrole
        </ul>
        <div class="navigation-background"></div><a
            class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only"
            href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
    </aside>

    <div id="main">
        <div class="row">
            <div class="content-wrapper-before blue-grey lighten-5" style="height: calc(100vh - 64px)"></div>
            <div class="col s12">
                <div class="container">


                    @yield('content')

                    <!-- START RIGHT SIDEBAR NAV -->
                    @role('super-admin')
                    <aside id="right-sidebar-nav">
                        <div id="slide-out-right" class="slide-out-right-sidenav sidenav rightside-navigation">
                            <div class="row">
                                <div class="slide-out-right-title">
                                    <div class="col s12 border-bottom-1 pb-0 pt-1">
                                        <div class="row">
                                            <div class="col s2 pr-0 center">
                                                <i class="material-icons vertical-text-middle"><a href="#"
                                                        class="sidenav-close">clear</a></i>
                                            </div>
                                            <div class="col s10 pl-0">
                                                <ul class="tabs">

                                                    <li class="tab col s12 p-0">
                                                        <a href="#activity" class="active">
                                                            <span>Bilgiler</span>
                                                            
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="slide-out-right-body">

                                    <div id="activity" class="col s12">
                                        <div class="activity">
                                            <ul class="collection with-header">  
                                
                                                <a class="grey-text text-darken-2" href="#!"><span
                                                            class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new
                                                        order has been placed!</a>
                                                    <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">2 saat önce</time>
                                    
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                    </aside>
                    <!-- END RIGHT SIDEBAR NAV -->
                    <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a
                            class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i
                                class="material-icons">blur_on</i></a>
                        <ul>
                            <li><a href="{{asset('/')}}" class="btn-floating green"><i
                                        class="material-icons">home</i></a></li>
                            <li><a href="{{asset('/araclarim')}}" class="btn-floating amber"><i
                                        class="material-icons">directions_car</i></a></li>
                            <li><a href="{{asset('/musterilerim')}}" class="btn-floating red"><i
                                        class="material-icons">assignment_ind</i></a></li>
                            <li><a data-target="modal3" class="btn-floating blue modal-trigger"><i
                                        class="material-icons">add</i></a></li>
                        </ul>
                    </div>
                    @endrole()
                </div>
            </div>

        </div>
    </div>
    <!-- END: Page Main-->

    <!-- BEGIN: Footer-->

    <footer class="page-footer footer footer-static footer-light navbar-border navbar-shadow">
        <div class="footer-copyright">
            <div class="container"><span>&copy; 2019 <a href="http://kodgaraj.com" target="_blank">KODGARAJ</a> Tüm
                    Hakları Saklıdır.</span></div>
        </div>
    </footer>
    
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    
    <script src="{{ asset('app-assets/js/vendors.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/plugins.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/custom/custom-script.js') }}" type="text/javascript"></script>
    <script src="{{ asset('app-assets/vendors/data-tables/js/jquery.dataTables.js') }}" type="text/javascript"> </script>
        <script src="{{ asset('app-assets/vendors/sparkline/jquery.sparkline.min.js') }}"></script>
       
        
    <script src="{{ asset('app-assets/vendors/data-tables/extensions/responsive/js/dataTables.responsive.min.js') }}"
        type="text/javascript"></script>
    <script src="{{ asset('app-assets/js/scripts/css-animation.js') }}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/scripts/advance-ui-modals.js')}}" type="text/javascript"></script>
    @yield('js')

</body>

</html>
