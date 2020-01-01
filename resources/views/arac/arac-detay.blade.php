<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Araç Detay Sayfası</title>
    <link rel="apple-touch-icon" href="{{asset('images/favicon/apple-touch-icon-152x152.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('app-assets/images/favicon/favicon-32x32.png')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('/app-assets/css/themes/vertical-dark-menu-template/materialize.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('/app-assets/css/themes/vertical-dark-menu-template/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/dashboard.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/custom/custom.css')}}">
    <style>
        .toast {
            display: none;
        }

    </style>
</head>

<body>
    @auth
        @role('admin')
            <div style="bottom: 50px; right: 20px;" class="fixed-action-btn direction-top">
                <a class="btn-floating btn-large primary-text gradient-shadow modal-trigger" href="#modalislem">
                    <i class="material-icons">add</i>
                </a>
            </div>

            <div id="modalislem" class="modal border-radius-6">
                <form action="{{route('faturaOlustur')}}" method="POST">
                        @csrf
                    <div class="modal-content">
                        <h4>Fatura Oluştur</h4>
                        <div class="col s6">
                        
                                <div class="input-field">
                                    <select name="islem_id">
                                        <option value="" disabled selected>İşlem Seçiniz</option>
                                        @foreach ($aracdetay->Islemler as $Islemler)
                                        <option value="{{$Islemler->id}}">{{$Islemler->id}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-field">
                                            <label for="km">Fatura No: <span class="red-text">*</span></label>
                                            <input type="text" class="validate" id="fatura_no" name="fatura_no" required>
                                    </div>
                                </div>
                            
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat ">Oluştur</button>
                </div>
                </form>
            </div>
        @endrole
    @endauth
    <div class="row">
        <div id="breadcrumbs-wrapper" data-image="{{asset('app-assets/images/gallery/breadcrumb-bg.jpg')}}"
            class="breadcrumbs-bg-image"
            style="background-image: url(&quot;{{asset('app-assets/images/gallery/breadcrumb-bg.jpg')}}&quot;);">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        <div class="col s6 m6 l6">
                            <h5 class="breadcrumbs-title uppercase mt-0 mb-0">
                                {{str_replace("_", " ", $aracdetay->plaka)}} Plakalı Arac Detayları</h5>
                        </div>
                        @auth
                            <div class="col s6 m6 l6 right-align">
                                <a href="{{asset('/araclarim')}}"
                                    class="mb-6 btn waves-effect waves-light gradient-45deg-amber-amber">Geri Dön</a>
                            </div>
                        @endauth
                    </div>
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
                        <i class="material-icons amber-text small-ico-bg mb-5">near_me</i>
                        <h4 class="m-0"><b>{{$aracdetay->km}}</b></h4>
                        <p> Araç Kilometresi</p>
                    </div>
                </div>
        </div>
    </div>
    <ul class="collapsible popout">
        @foreach ($aracdetay->Fatura as $Fatura)
        <li>
            <div class="collapsible-header"><i class="material-icons">assignment_turned_in</i>Fatura No : {{$Fatura->fkod}}</div>
                            
                <div class="collapsible-body">
                    <div id="responsive-table" class="scrollspy">
                        <div class="card-content">
                            <table class="responsive-table">
                                <thead>
                                    <tr>
                                        <th>Yapılan İşlemler</th>
                                        <th>Adet</th>
                                        <th>Alınan Ücret</th>
                                        @auth
                                            @role('admin')
                                                <th><a class="btn-flat mb-1 waves-effect" href="{{asset('/fatura/'.$Fatura->fkod)}}" target="_blank"> <i class="material-icons right">print</i></a></th>
                                            @endrole
                                        @endauth
                                        <!-- <th>Servis Giriş Tarihi = {/{$Fatura->IslemHizmetleri[0]->Hizmet->created_at}}</th> -->
                                </thead>
                                <tbody>
                                    @foreach ($Fatura->IslemHizmetleri as $Islem)
                                    <tr>
                                        <td>{{$Islem->Hizmet->ad}} </td>
                                        <td>{{$Islem->adet}}</td>
                                        <td>{{$Islem->hizmet_fiyat * $Islem->adet}}</td>
                                        @auth
                                            @role('admin')
                                                <th></th>
                                            @endrole
                                        @endauth
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
        @endforeach
    </ul>

    <script src="{{asset('app-assets/js/vendors.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/plugins.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/custom/custom-script.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/scripts/customizer.js')}}" type="text/javascript"></script>

    <script src="{{asset('app-assets/js/scripts/advance-ui-modals.js')}}" type="text/javascript"></script>
</body>

</html>
