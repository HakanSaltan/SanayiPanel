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
<body>
    <div class="col s12">
          <div class="container">
            <div class="seaction">
  <div class="row">
    <div class="col s12 m12 l12">
      <div id="basic-tabs" class="card card card-default scrollspy">
        <div class="card-content pt-5 pr-5 pb-5 pl-5">
          <div id="invoice">
            <div class="invoice-header">
              <div class="row section">
                <div class="col s12 m6 l6">
                  <img class="mb-2 width-50" src="../../../app-assets/images/logo/materialize-logo-big.png" alt="company logo">
                  <p>Semerciler Mahallesi Sait Faik Sokak No : 10 Daire 2 </p>
                  <p>0850 303 85 54</p>
                </div>
                <div class="col s12 m6 l6">
                <h4 class="text-uppercase right-align strong mb-5">Fatura {{$fatura->fkod}}</h4>
                </div>
              </div>
              <div class="row section">
                <div class="col s12 m6 l6">
                  <h6 class="text-uppercase strong mb-2 mt-3">ALICI</h6>
                <p class="text-uppercase">{{$kullanici->isimSoyisim}}</p>
                  <p>{{$kullanici->adres}}</p>
                  <p>Vergi Dairesi : Sakarya</p>
                  <p>Vergi Numarası : {{$kullanici->tc}}</p>
                  <p>Telefon No: {{$kullanici->telefon}}</p>
                </div>
                <div class="col s12 m6 l6">
                  <div class="invoce-no right-align">
                  <p><span class="text-uppercase strong">Fatura Tarihi</span> {{date('d-m-Y')}}</p>
                  </div>
                  <div class="invoce-no right-align">
                    <p><span class="text-uppercase strong">İrsaliye Tarihi</span> 03 Kasım 2019</p>
                  </div>
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
                          <td>{{$hizmet->parcaUcret * $IslemHizmetleri->adet}}</td>
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
                        <td class="cyan white-text pl-1">Genel Toplam</td>
                        <td class="cyan strong white-text">159.00 ₺</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="invoice-footer mt-6">
              <div class="row">
                <div class="col s12 m6 l6">
                  <p class="strong">Fatura Notu</p>
                  <p>Please make the cheque to: AMANDA ORTON</p>
                  
                </div>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>      
          </div>
        </div>

    
</body>
</html>