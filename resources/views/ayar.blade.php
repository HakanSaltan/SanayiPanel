<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Otogaraj') }} | Kurulum Sayfası</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/vendors.min.css')}}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css"
        href="{{asset('app-assets/css/themes/vertical-dark-menu-template/materialize.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('app-assets/css/themes/vertical-dark-menu-template/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/register.css')}}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/custom/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/form-wizard.css')}}">
    <link rel="stylesheet" type="text/css"
        href="{{asset('app-assets/vendors/materialize-stepper/materialize-stepper.min.css')}}">

    <!-- END: Custom CSS-->
</head>
<!-- END: Head-->

<body
    class="vertical-layout page-header-light vertical-menu-collapsible vertical-dark-menu 1-column register-bg  blank-page blank-page"
    data-open="click" data-menu="vertical-dark-menu" data-col="1-column">
    <div class="row">
        <div class="col s12">
            <div class="container">
                <div id="register-page" class="row">
                    <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 register-card bg-opacity-8">
                        <form class="login-form">
                            <ul class="stepper horizontal" id="horizStepper">
                                <li class="step active">
                                    <div class="step-title waves-effect">Step 1</div>
                                    <div class="step-content">
                                        <img src="{{asset('app-assets/images/gallery/intro-slide-1.png')}}" alt=""
                                            class="responsive-img animated fadeInUp slide-1-img">
                                        <h5 class=" mt-7 center animated fadeInUp">Otogaraja Hoşgeldiniz
                                        </h5>
                                        <p class="mt-5 animated fadeInUp">Sayfanızı özelleştirebilmemiz
                                            için
                                            sizden
                                            birkaç bilgi isteyeceğiz. <br> Hadi Başlayalım</p>
                                    </div>
                                </li>
                                <li class="step">
                                    <div class="step-title waves-effect">Step 2</div>
                                    <img src="{{asset('app-assets/images/gallery/intro-features.png')}}" alt=""
                                        class="responsive-img slide-2-img">
                                    <h5 class="mt-7 center">Firma Bilgileri</h5>
                                    <p class="mt-5"></p>
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
                                                <input placeholder="Firma Telefon Giriniz" id="firma_telefon"
                                                    type="text" class="validate">
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
                                                <input placeholder="Firma Adresini Giriniz" id="firma_adresi"
                                                    type="text" class="validate">
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="step">
                                    <div class="step-title waves-effect">Step 3</div>
                                    <img src="{{asset('app-assets/images/gallery/intro-app.png')}}" alt=""
                                        class="responsive-img slide-2-img">
                                    <h5 class=" mt-7 center">Firma Logosu</h5>
                                    <p class="mt-5"></p>
                                    <div class="row">
                                        <div class="col s12 center">
                                            <p>Maximum 2 MB Boyutunda Logo Yükleyebilirsiniz.</p>
                                            <input type="file" id="input-file-max-fs" class="dropify"
                                                data-max-file-size="2M" />
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col s12 center">
                                            <button onclick="firmaKayit({{Auth::user()->id}})"
                                                class="get-started btn waves-effect waves-light gradient-45deg-purple-deep-orange mt-3 modal-close">Hadi
                                                Başlayalım</button>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{asset('app-assets/js/vendors.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/custom/custom-script.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/plugins.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/js/scripts/form-wizard.js')}}" type="text/javascript"></script>
    <script src="{{asset('app-assets/vendors/materialize-stepper/materialize-stepper.min.js')}}" type="text/javascript">
    </script>




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
</body>

</html>
