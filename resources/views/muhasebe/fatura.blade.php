<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fatura Sayfası</title>
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
<?php 
    $ayarlar =\App\userAyar::where('user_id','=', Auth::user()->id)->get();
    $ayar = $ayarlar[0]->ayarJSON;
    $ayar = json_decode($ayar);
 ?>
<body>
    <div class="row">
        <div id="breadcrumbs-wrapper" data-image="{{asset('/app-assets/images/gallery/breadcrumb-bg.jpg')}}"
            class="breadcrumbs-bg-image"
            style="background-image: url(&quot;{{asset('/app-assets/images/gallery/breadcrumb-bg.jpg')}}&quot;);">
            <!-- Search for small screen-->
            <div class="container">
                <div class="row">
                    <div class="col s6 m6 l6">
                        <h5 class="breadcrumbs-title text-uppercase strong mb-5">Faura No: {{$fatura->fkod}} </h5>
                    </div>
                    <div class="col s6 m6 l6">
                        <div class="invoce-no right-align">
                            <p><span class="text-uppercase strong">Fatura Tarihi: </span> {{date('d-m-Y')}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="invoice">
                <div class="invoice-header">
                    <div class="row section">

                        <div class="col s6 m6 l6">
                            <img class="mb-2 width-40" src="{{asset($ayar->firma_logo->yol)}}"
                                alt="company logo">
                            <h6>{{$ayar->firma_adi}} </h6>
                            <p>Adres :{{$ayar->firma_adresi}} </p>
                            <p>Telefon No :{{$ayar->firma_telefon}}</p>
                        </div>
                        <div class="col s6 m6 l6 right-align">
                            <h6 class="text-uppercase strong mb-2 mt-3">ALICI</h6>
                            <p class="text-uppercase">{{$kullanici->isimSoyisim}}</p>
                            <p>{{$kullanici->adres}}</p>
                            <p>Tc Numarası : {{$kullanici->tc}}</p>
                            <p>Telefon No : {{$kullanici->telefon}}</p>
                        </div>

                    </div>
                </div>
                <div class="invoice-table">
                    <div class="row">
                        <div class="col s12 m12 l12">
                            <table class="highlight responsive-table">
                                <thead>
                                    <tr>
                                        <th data-field="no">No</th>
                                        <th data-field="item">Hizmet</th>
                                        <th data-field="uprice">Birim Fiyat</th>
                                        <th data-field="price">Birim</th>
                                        <th data-field="price">Toplam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fatura->IslemHizmetleri as $IslemHizmetleri)
                                    @foreach ($IslemHizmetleri->HizmetMany as $hizmet)
                                    <tr>
                                        <td>{{$hizmet->hkod}}</td>
                                        <td>{{$hizmet->ad}}</td>
                                        <td>{{$hizmet->fiyat}}</td>
                                        <td>{{$IslemHizmetleri->adet}}</td>
                                        <td>{{$IslemHizmetleri->hizmet_fiyat * $IslemHizmetleri->adet}}</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                    <tr class="border-none">
                                        <td colspan="3"></td>
                                        <td>Ara Toplam:</td>
                                        <td>50.00 ₺</td>
                                    </tr>
                                    <tr class="border-none">
                                        <td colspan="3"></td>
                                        <td>Hizmet Bedeli:</td>
                                        <td>100.00 ₺</td>
                                    </tr>
                                    <tr class="border-none">
                                        <td colspan="3"></td>
                                        <td>KDV %</td>
                                        <td>18</td>
                                    </tr>
                                    <tr class="border-none">
                                        <td colspan="3"></td>
                                        <td class="strong">Genel Toplam</td>
                                        <td class="strong">159.00 ₺</td>
                                    </tr>
                                </tbody>
                            </table>


                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.print()
    </script>
</body>

</html>