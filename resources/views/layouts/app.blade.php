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
    $qrCodes = \App\qrOkutulan::all();
    $ayarlar =\App\userAyar::where('user_id','=', Auth::user()->id)->get();
    $ayar = $ayarlar[0]->ayarJSON;
    $ayar = json_decode($ayar);
 ?>
 <?php
 $Musteriler = \App\Musteri::where('user_id',Auth::user()->id)->get();
 $araclar = \App\Arac::where('musteri_id',"0")->where('user_id',Auth::user()->id)->get();
 ?>
<body class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu 2-columns  "
    data-open="click" data-menu="vertical-dark-menu" data-col="2-columns">

    <!-- BEGIN: Header-->
    <header class="page-topbar" id="header">
        <div class="navbar navbar-fixed">
            <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-light">
                <div class="nav-wrapper">
                <form action="{{asset('/araclarim')}}">
                        <div class="header-search-wrapper hide-on-med-and-down"><i class="material-icons">search</i>
                            <input class="header-search-input z-depth-2" type="text" name="plakaAra"
                                placeholder="Plaka Giriniz">
                        </div>
                    
                    <ul class="navbar-list right">
                        <li class="hide-on-large-only"><a class="waves-effect waves-block waves-light search-button"
                                href="javascript:void(0);"><i class="material-icons">search</i></a></li>
                        
                        <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);"
                                data-target="profile-dropdown"><span class="avatar-status avatar-online"><img
                                        src="{{ asset('app-assets/images/avatar/avatar-7.png') }}"
                                        alt="avatar"><i></i></span></a></li>
                        <li><a class="waves-effect waves-block waves-light sidenav-trigger" href="#"
                                data-target="slide-out-right"><i class="material-icons">format_indent_increase</i></a>
                        </li>
                    </ul>
                </form>
                    <!-- profile-dropdown-->
                    <ul class="dropdown-content" id="profile-dropdown">
                        <li><a class="grey-text text-darken-1" href="{{ route('profile') }}"><i
                                    class="material-icons">person_outline</i> Profil Görüntüle</a></li>
                        <li class="divider"></li>

                        <li><a class="grey-text text-darken-1" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                    class="material-icons">lock_outline</i> {{ __('Çıkış Yap') }}</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                        </li>

                    </ul>
                </div>
               
            </nav>
        </div>
    </header>
    <!-- END: Header-->

    <!-- BEGIN: SideNav-->
    <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-dark sidenav-active-rounded">
        <div class="brand-sidebar">
            <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{asset('/')}}"><span
                        class="logo-text hide-on-med-and-down">
                        @if (isset($ayar->firma_adi))
                            {{$ayar->firma_adi}}
                        @else
                        {{ config('app.name', 'Otogaraj') }}
                        @endif
                        
                    </span></a><a
                    class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
            
        </div>
        <ul class="sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out"
            data-menu="menu-navigation" data-collapsible="accordion">

            <li class="bold"><a class="waves-effect waves-cyan " href="{{asset('/home')}}"><i
                        class="material-icons">mail_outline</i><span class="menu-title" data-i18n="">Anasayfa</span></a>
            </li>
            
            @role('admin')
            <li class="navigation-header"><a class="navigation-header-text">Araçlar</a><i
                    class="navigation-header-icon material-icons">more_horiz</i>
            </li>
            <li class="bold"><a class="collapsible-header waves-effect waves-cyan " href="#"><i
                        class="material-icons">settings_input_svideo</i><span class="menu-title"
                        data-i18n="">Araç</span><span class="badge badge pill orange float-right mr-10">1</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li><a class="collapsible-body" href="{{asset('/araclarim')}}" data-i18n=""><i
                                    class="material-icons">radio_button_unchecked</i><span>Araç Bilgisi</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li ><a class="collapsible-header waves-effect waves-cyan " href="#"><i
                        class="material-icons">dvr</i><span class="menu-title" data-i18n="">Müşteriler</span><span
                        class="badge badge pill orange float-right mr-10">1</span></a>
                <div class="collapsible-body">
                    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
                        <li><a class="collapsible-body" href="{{asset('/musterilerim')}}" data-i18n=""><i
                                    class="material-icons">radio_button_unchecked</i><span>Müşteri Bilgisi</span></a>
                        </li>
                    </ul>
                </div>
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
                    @role('admin')
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
                                                            <span>QR Okutulanlar</span>
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
                                                @if(!empty($qrCodes))
                                                @foreach ($qrCodes as $qrCode)
                                                <li class="collection-item">
                                                    <div class="font-weight-900">
                                                        <a class="bold">{{$qrCode->Arac->plaka}}</a> <span
                                                            class="secondary-content">{{$qrCode->Arac->Musteri->isimSoyisim}}</span>
                                                    </div>
                                                    <p class="mt-0 mb-2">{{$qrCode->created_at}}</p>
                                                    </span>
                                                </li>
                                                @endforeach
                                                @endif
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div id="modal3" class="modal modal-fixed-footer">
                            <div class="modal-content">
                                
                                    <div class="card-content">
                                                <h4 class="card-title">Müşteriye Araç Ata</h4>
                                        <div class="input-field col m6 s12">
                                            <select name="mid" id="mid">
                                                <option value="" disabled selected>Lütfen Müşteri Seçiniz
                                                </option>
                                                @foreach ($Musteriler as $musteri)
                                                <option value="{{$musteri->id}}">{{$musteri->isimSoyisim}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-field col m6 s12">
                                            <select name="arac_id" id="arac_id">
                                                <option value="" disabled selected>Lütfen Araç Seçiniz</option>
                                                @foreach ($araclar as $arac)
                                                <option value="{{$arac->id}}">{{$arac->plaka}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    
                                    </div>
                              
                            </div>
                            <div class="modal-footer">
                                <button onclick="musteriArac()" class="btn modal-close waves-effect waves-light mr-2">Kaydet</button>
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
            <div class="col s1"></div>
                <div class="col s6">
                    &copy; 2019 <a href="http://kodgaraj.com" target="_blank">KODGARAJ</a> Tüm Hakları Saklıdır. 
                </div>
                <div class="col s6">
                    Tarih : {{date('d-m-Y')}}
                </div>
                
            <div class="col s1">  </div>
        </div>
    </footer>

    <script>
        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var radius = canvas.height / 2;
        ctx.translate(radius, radius);
        radius = radius * 0.90
        setInterval(drawClock, 1000);

        function drawClock() {
            drawFace(ctx, radius);
            drawTime(ctx, radius);
        }

        function drawFace(ctx, radius) {
            // var grad;
            ctx.beginPath();
            ctx.arc(0, 0, radius, 0, 2*Math.PI);
            ctx.fillStyle = 'white';
            ctx.fill();
            /*grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
            grad.addColorStop(0, '#333');
            grad.addColorStop(0.5, 'white');
            grad.addColorStop(1, '#333');
            ctx.strokeStyle = grad;*/
            ctx.lineWidth = radius*0.1;
            ctx.stroke();
            ctx.beginPath();
            /*ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
            ctx.fillStyle = '#333';
            ctx.fill();*/
        }

        function drawNumbers(ctx, radius) {
            var ang;
            var num;
            ctx.font = radius*0.15 + "px arial";
            ctx.textBaseline="middle";
            ctx.textAlign="center";
            for(num = 1; num < 13; num++){
                ang = num * Math.PI / 6;
                ctx.rotate(ang);
                ctx.translate(0, -radius*0.85);
                ctx.rotate(-ang);
                ctx.fillText(num.toString(), 0, 0);
                ctx.rotate(ang);
                ctx.translate(0, radius*0.85);
                ctx.rotate(-ang);
            }
        }

        function drawTime(ctx, radius){
            var now = new Date();
            var hour = now.getHours();
            var minute = now.getMinutes();
            var second = now.getSeconds();
            //hour
            hour=hour%12;
            hour=(hour*Math.PI/6)+
            (minute*Math.PI/(6*60))+
            (second*Math.PI/(360*60));
            drawHand(ctx, hour, radius*0.5, radius*0.07);
            //minute
            minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
            drawHand(ctx, minute, radius*0.8, radius*0.07);
            // second
            second=(second*Math.PI/30);
            drawHand(ctx, second, radius*0.9, radius*0.02);
        }

        function drawHand(ctx, pos, length, width) {
            ctx.beginPath();
            ctx.lineWidth = width;
            ctx.lineCap = "round";
            ctx.moveTo(0,0);
            ctx.rotate(pos);
            ctx.lineTo(0, -length);
            ctx.stroke();
            ctx.rotate(-pos);
        }
    </script>
    
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
