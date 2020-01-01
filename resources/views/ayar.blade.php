<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Otogaraj') }}</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/intro.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/dropify/css/dropify.min.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/animate-css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/flag-icon/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css"
    href="{{ asset('app-assets/css/themes/vertical-dark-menu-template/materialize.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('app-assets/css/themes/vertical-dark-menu-template/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/custom/custom.css') }}">
</head>

<body style="background-color:#25a3ff">
        <div class="col s6 right-align">
            <a href="{{URL::to('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mb-6 btn waves-effect waves-light red accent-2 modal-trigger ">Çıkış Yap</a>
        <form id="logout-form" action="{{ URL::route('logout') }}" method="post">
            {{ csrf_field() }}
        </form>
           
        </div>
    <div id="intro">
        <div class="row">
            <div class="col s12">
                <div class="row center">
                    <h4 style="color:white">LÜTFEN BEKLEYİNİZ</h4>
                </div>
                <div id="img-modal" class="modal white">
                    <div class="modal-content">
                        <div class="bg-img-div"></div>
                        <p class="modal-header right modal-close">
                            <span class="right"><i class="material-icons right-align">clear</i></span>
                        </p>
                        <div class="carousel carousel-slider center intro-carousel">
                            <div class="carousel-fixed-item center middle-indicator">
                                <div class="left">
                                    <button
                                        class="movePrevCarousel middle-indicator-text btn btn-flat purple-text waves-effect waves-light btn-prev">
                                        <i class="material-icons">navigate_before</i> <span
                                            class="hide-on-small-only">Geri</span>
                                    </button>
                                </div>

                                <div class="right">
                                    <button
                                        class=" moveNextCarousel middle-indicator-text btn btn-flat purple-text waves-effect waves-light btn-next">
                                        <span class="hide-on-small-only">İleri</span> <i
                                            class="material-icons">navigate_next</i>
                                    </button>
                                </div>
                            </div>
                            <div class="carousel-item slide-1">
                                <img src="{{asset('app-assets/images/gallery/intro-slide-1.png')}}" alt=""
                                    class="responsive-img animated fadeInUp slide-1-img">
                                <h5 class="intro-step-title mt-7 center animated fadeInUp">Otogaraja Hoşgeldiniz</h5>
                                <p class="intro-step-text mt-5 animated fadeInUp">Sayfanızı özelleştirebilmemiz için
                                    sizden
                                    birkaç bilgi isteyeceğiz. <br> Hadi Başlayalım</p>
                            </div>
                            <div class="carousel-item slide-2">
                                <img src="{{asset('app-assets/images/gallery/intro-features.png')}}" alt=""
                                    class="responsive-img slide-2-img">
                                <h5 class="intro-step-title mt-7 center">Firma Bilgileri</h5>
                                <p class="intro-step-text mt-5"></p>
                                <div class="row">
                                    <div class="col s6">
                                        <div class="input-field">
                                            <label for="firma_adi">Firma Adı</label>
                                            <input placeholder="Firma Adını Giriniz" id="firma_adi" type="text"
                                                class="validate">
                                        </div>
                                    </div>
                                    <div class="col s6">
                                            <div class="input-field">
                                                <label for="firma_sahibi">Firma Sahibi</label>
                                                <input placeholder="Firma Sahibi Giriniz" id="firma_sahibi" type="text"
                                                    class="validate">
                                            </div>
                                    </div>
                                    <div class="col s6">
                                            <div class="input-field">
                                                <label for="first_telefon">Firma Telefon</label>
                                                <input placeholder="Firma Telefon Giriniz" id="firma_telefon" type="text"
                                                    class="validate">
                                            </div>
                                        </div>
                                        <div class="col s6">
                                            <div class="input-field">
                                                <div class="input-field">
                                                    <label for="firma_turu">Firma Türü</label>
                                                    <input placeholder="Firma Türü Giriniz" id="firma_turu" type="text"
                                                        class="validate">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12">
                                                <div class="input-field">
                                                    <label for="firma_adresi">Firma Adresi</label>
                                                    <input placeholder="Firma Adresini Giriniz" id="firma_adresi" type="text"
                                                        class="validate">
                                                </div>
                                        </div>
                                </div>
                            </div>
                            <div class="carousel-item slide-3">
                                <img src="{{asset('app-assets/images/gallery/intro-app.png')}}" alt=""
                                    class="responsive-img slide-2-img">
                                <h5 class="intro-step-title mt-7 center">Firma Logosu</h5>
                                <p class="intro-step-text mt-5"></p>
                                <div class="row">
                                    <div class="col s12 center">
                                        <p>Maximum 2 MB Boyutunda Logo Yükleyebilirsiniz.</p>
                                        <input type="file" id="input-file-max-fs" class="dropify" data-max-file-size="2M" />
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col s12 center">
                                        <button onclick="firmaKayit({{Auth::user()->id}})"
                                            class="get-started btn waves-effect waves-light gradient-45deg-purple-deep-orange mt-3">Hadi
                                            Başlayalım</button>
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

<script src="{{asset('app-assets/js/vendors.min.js')}}" type="text/javascript"></script>

<script src="{{asset('app-assets/vendors/dropify/js/dropify.min.js')}}"></script>

<script src="{{asset('app-assets/js/plugins.js')}}" type="text/javascript"></script>
<script src="{{ asset('app-assets/js/custom/custom-script.js') }}" type="text/javascript"></script>

<script src="{{asset('app-assets/js/scripts/intro.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/js/scripts/form-file-uploads.js')}}"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="{{ asset('app-assets/js/scripts/css-animation.js') }}" type="text/javascript"></script>

<script>
    function firmaKayit(id) {
        console.log(id);
        let firma_adi = document.querySelector("#firma_adi");
        let firma_sahibi = document.querySelector("#firma_sahibi");
        let firma_telefon = document.querySelector("#firma_telefon");
        let firma_adresi = document.querySelector("#firma_adresi");
        let firma_logo = document.querySelector("#input-file-max-fs.dropify");
        firma_logo = firma_logo.files[0];
        let formData = new FormData();
        formData.append("id", id);
        formData.append("firma_adi", firma_adi.value);
        formData.append("firma_sahibi", firma_sahibi.value);
        formData.append("firma_telefon", firma_telefon.value);
        formData.append("firma_adresi", firma_adresi.value);
        formData.append("firma_logo", firma_logo);
        console.log(firma_adi.value, firma_sahibi.value, firma_telefon.value, firma_adresi.value, firma_logo);
        axios.post("/firmaKayit", formData)
        .then(donen => {
            console.log(donen);
            location.href = "/home";
        })
        .catch(error => {
            console.log(error);
        });
    }
    

   
</script>

</html>