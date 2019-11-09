<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Araç Detay Sayfası</title>
    <link rel="apple-touch-icon" href="{{asset('/images/favicon/apple-touch-icon-152x152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/app-assets/images/favicon/favicon-32x32.png')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/vendors/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('/app-assets/css/themes/vertical-dark-menu-template/materialize.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('/app-assets/css/themes/vertical-dark-menu-template/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/pages/dashboard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/app-assets/css/custom/custom.css')}}">
    <style>
        .toast {
            display: none;
        }

    </style>
</head>

<body>

    <div class="row">
        <div id="breadcrumbs-wrapper" data-image="{{asset('/app-assets/images/gallery/breadcrumb-bg.jpg')}}"
            class="breadcrumbs-bg-image"
            style="background-image: url(&quot;{{asset('/app-assets/images/gallery/breadcrumb-bg.jpg')}}&quot;);">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s12 m6 l6">
                        <h5 class="breadcrumbs-title mt-0 mb-0">{{$aracdetay->plaka}} Plakalı Arac Detayları</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m6 l3 card-width">
                <div class="card border-radius-6">
                    <div class="card-content center-align">
                        <i class="material-icons amber-text small-ico-bg mb-5">near_me</i>
                        <h4 class="m-0"><b>{{$aracdetay->km}}</b></h4>
                        <p> Araç Kilometresi</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3 card-width">
                <div class="card border-radius-6">
                    <div class="card-content center-align">
                        <i class="material-icons amber-text small-ico-bg mb-5">directions_car</i>
                        <h4 class="m-0"><b>{{$aracdetay->marka}}</b></h4>
                        <p>Araç Markası</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3 card-width">
                <div class="card border-radius-6">
                    <div class="card-content center-align">
                        <i class="material-icons amber-text small-ico-bg mb-5">eject</i>
                        <h4 class="m-0"><b>{{$aracdetay->model}}</b></h4>
                        <p>Araç Modeli</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l3 card-width">
                <div class="card border-radius-6">
                    <div class="card-content center-align">
                        <i class="material-icons amber-text small-ico-bg mb-5">face</i>
                        <h4 class="m-0"><b>{{$aracdetay->Musteri->isimSoyisim}}</b></h4>
                        <p>Araç Sahibi</p>

                    </div>
                </div>
            </div>

        </div>
        @foreach ($aracdetay->Fatura as $Fatura)
        <div class="row">
            <div class="col s12">
                <div id="responsive-table" class="card card card-default scrollspy">
                    <div class="card-content">
                        <h2 class="card-title stripe">Fatura No : {{$Fatura->fatura_id}}</h2>
                        <table class="responsive-table">
                            <thead>

                                <tr>
                                    <th>Plaka</th>
                                    <th>Sahibi</th>
                                    <th>Kilometresi</th>
                                    <th>Markası</th>
                                    <th>Modeli</th>
                                    <th>Şase Numarası</th>
                                    <th>Servis Giriş Tarihi</th>
                                    <th>Servis Çıkış Tarihi</th>
                                    <th>Yapılan İşlemler</th>
                                    <th>Adet</th>
                                    <th>Alınan Ücret</th>
                                    <th><a class="btn-flat mb-1 waves-effect" href="{{asset('/fatura/'.$Fatura->fatura_id)}}">
                                            <i class="material-icons right">print</i></a></th>
                            </thead>
                            <tbody>

                                @foreach ($Fatura->Hizmet as $hizmet)

                                <tr>
                                    <td>{{$aracdetay->plaka}}</td>
                                    <td>{{$aracdetay->Musteri->isimSoyisim}}</td>
                                    <td>{{$aracdetay->km}}</td>
                                    <td>{{$aracdetay->marka}}</td>
                                    <td>{{$aracdetay->model}}</td>
                                    <td>584213215151</td>
                                    <td>{{$hizmet->created_at}}</td>
                                    <td>{{$hizmet->tarih}}</td>
                                    <td>{{$hizmet->parca}} </td>
                                    <td>{{$hizmet->adet}}</td>
                                    <td>{{$hizmet->parcaUcret}}</td>
                                    <th></th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Print Button -->
        <div style="bottom: 50px; right: 19px;" class="fixed-action-btn direction-top"><a
                class="btn-floating btn-large gradient-45deg-light-blue-cyan gradient-shadow"><i
                    class="material-icons">print</i></a>
        </div>
        <!-- Print Button -->
    </div>




    <script src="{{asset('/app-assets/js/vendors.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/app-assets/vendors/chartjs/chart.min.js')}}"></script>
    <script src="{{asset('/app-assets/js/plugins.js')}}" type="text/javascript"></script>
    <script src="{{asset('/app-assets/js/custom/custom-script.js')}}" type="text/javascript"></script>
    <script src="{{asset('/app-assets/js/scripts/dashboard-ecommerce.js')}}" type="text/javascript"></script>
</body>

</html>
