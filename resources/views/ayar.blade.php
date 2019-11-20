<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Otogaraj') }}</title>

    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/favicon/apple-touch-icon-152x152.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/favicon/favicon-32x32.png') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/intro.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/dropify/css/dropify.min.css') }}">
</head>

<body style="background-color:#25a3ff">

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
                                                <select name="firma_turu">
                                                    <option value="" disabled selected>Firma Türü Seçiniz</option>
                                                    <option value="1980">Kaportacı</option>
                                                    <option value="1990">Boyacı</option>
                                                    <option value="2000">Motorcu</option>
                                                    <option value="2010">Egzozcu</option>
                                                    <option value="2020">Tekerci</option>
                                                </select>
                                                <label>Firma Türü</label>
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
                                            class="get-started btn waves-effect waves-light gradient-45deg-purple-deep-orange mt-3 modal-close">Hadi
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
<script src="{{asset('app-assets/js/custom/custom-script.js')}}" type="text/javascript"></script>

<script src="{{asset('app-assets/js/scripts/intro.js')}}" type="text/javascript"></script>
<script src="{{asset('app-assets/js/scripts/form-file-uploads.js')}}"></script>

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
        })
        .catch(error => {
            console.log(error);
        });
    }

    $(document).ready(function () {
        $("#img-modal").openModal({
            dismissible: false
        })
    })

</script>

</html>
