<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="apple-touch-icon" sizes="57x57" href="/icon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/icon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/icon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/icon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/icon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/icon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/icon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/icon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/icon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/icon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/icon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/icon/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json"> -->
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/icon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <title>Sanayi</title>
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Livvic&display=swap" rel="stylesheet">
    <!-- Styles -->
    <style>
        * {
            font-family: 'Livvic', sans-serif;
        }
        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .top-left {
            position: absolute;
            left: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }


        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .m-b-xl {
            margin-bottom: 60px;
        }

        .login a {
            z-index: 10000000;
            color: white !important;
        }

        .kg-container {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .kg-app {
            flex: -30%;
        }

        .kg-main {
            flex: 100%;
        }
    </style>
</head>

<body>
    <!-- CSRF Token -->
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
    @if (session('status'))
    <!-- <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div> -->
    @endif

    <div class="top-left links login">
        <a id="geri-buton" href="javascript:_geri()"><- GERİ</a>
    </div>

    @if (Route::has('login'))
    <div class="top-right links login">
        @auth
        <a href="{{ url('/home') }}">{{Auth::user()->name}}</a>
        <a href="{{URL::to('logout') }}" onclick="event.preventDefault();
                                                      document.getElementById('logout-form').submit();">Çıkış Yap</a>
        <form id="logout-form" action="{{ URL::route('logout') }}" method="post">
            {{ csrf_field() }}
        </form>
        @else
        <a href="{{ route('login') }}">Giriş Yap</a>
        @endauth
    </div>
    @endif
    
    <div class="kg-container">
        <!--
        <div class="a_r kg-app">
            <div class="app">
              
                <div class="top-panel">
                    
                    <div class="left">
                        <div class="circles">
                            <span class="full"></span>
                            <span class="full"></span>
                            <span class="full"></span>
                            <span class="full"></span>
                            <span></span>
                        </div>
                        <div class="operator">
                            <p id="lang">--</p>
                        </div>
                    </div>
                 
                    <div class="center">
                        <div class="time">
                            <p id="time">--:--&nbsp;--</p>
                        </div>
                    </div>
                   
                    <div class="right">
                        <div class="percentage">
                            <p id="perc">--%</p>
                        </div>
                        <div class="battery">
                            <span class="icon"></span>
                        </div>
                    </div>
                </div>
    
                <div class="screen" id="screen" style="position: releative">
                    <div id="img" style="top: 50%; left:50%">
                        
                    </div>
                </div>
                <div class="clearfix"></div>
    
            </div>
        </div>
-->

        <div id="progress"></div>
        <div class="kg-main">
            <div class="center">
                <div id="register">
        
                    <i id="progressButton" class="ion-android-arrow-forward next"></i>
        
                    <div id="inputContainer">
                        <input id="inputField" required autofocus />
                        <label id="inputLabel"></label>
                        <div id="inputProgress"></div>
                    </div>
        
                </div>
            </div>
            <div id="mesaj"></div>
        </div>
    </div>

</body>


<script src="{{ URL::asset('Anasayfa/assets/js/jquery.min.js')}}"></script>


<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // iFrame saat işlemi
    // window.setInterval(function () {
    //     // current time
    //     var d = new Date();

    //     var time = {
    //         hours: d.getHours(),
    //         minutes: d.getMinutes(),
    //         ampm: d.getHours >= 12 ? "PM" : "AM"
    //     };

    //     // convert format into -> hh:mm am/pm
    //     time.hours = time.hours % 12;
    //     time.hours = time.hours ? time.hours : 12;
    //     time.minutes = time.minutes < 10 ? "0" + time.minutes : time.minutes;

    //     var string = time.hours + ":" + time.minutes + "&nbsp;" + time.ampm;
    //     document.getElementById("time").innerHTML = string;

    //     // get client language
    //     var lang = navigator.language;
    //     document.getElementById("lang").innerHTML = lang.toUpperCase();

    //     // battery level
    //     var battery = navigator.getBattery().then(function (battery) {
    //         document.getElementById("perc").innerHTML = (battery.level * 100).toFixed(0) + "%";
    //     });
    // }, 1000);

    @auth
    var questions = [
        { question: "Plaka Giriniz" },
        { question: "Telefon No Giriniz" },
        { question: "İsim Soyisim Giriniz" },
        { question: "Tc Giriniz" },
        { question: "Adres Giriniz" },
        
       // { question: "Email Adress ?", pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/ },
    ];
    
    @else
    var questions = [
        { question: "Plaka Giriniz" }
    ];
    @endauth



    ;

    var _geri;
    (function () {

        var tTime = 100
        var wTime = 200
        var eTime = 1000

        // init
        // --------------
        var position = 0

        var geriEl = document.getElementById("geri-buton");
        geriEl.style.display = "none";

        putQuestion()

        progressButton.addEventListener('click', validate)
        inputField.addEventListener('keyup', function (e) {

            transform(0, 0) // ie hack to redraw
            if (e.keyCode == 13) validate();

            // if(e.keyCode == 37) geri();
        })



        // load the next question
        function putQuestion() {
            inputLabel.innerHTML = questions[position].question
            if(questions[position].value)
                inputField.value = questions[position].value;
            else
                inputField.value = ''
            inputField.type = questions[position].type || 'text'
            inputField.focus()
            showCurrent()
        }

        let token;

        function musteriKayit() {
            let token = '{{csrf_token()}}';
            let plaka = questions[0].value;
            let telefon = questions[1].value;
            let isimSoyisim = questions[2].value;
            let tc = questions[3].value;
            let adres = questions[4].value;


            axios.post("/musteriKayit", {
                token: token,
                plaka: plaka,
                telefon: telefon,
                isimSoyisim: isimSoyisim,
                tc: tc,
                adres: adres
            })
            .then(res => {
                console.log("başarılı "+ res);
            })
            .catch(er => {
                console.log("başarısız "+ er);
            });
        }

        /*
                function keykayit(){
                    var deger = $cikti;
                    var token= '{{csrf_token()}}';
                    var url = questions[0].value;
                    
                    $.ajax({
                        url: '{{URL::asset('keykayit')}}',
                        type: 'GET',
                        data: {
                            _token: token,
                            deger: deger,
                            url: url,
                        },
                        dataType: 'JSON',
                        success: function (a) {
                            if (a.error) {
                                console.log("eror");
                                alert(a.error);
                            } else {
                                if (a.cevap) {
                                    console.log("başarılı");
                                    swal("Kayıt Başarılı!", "", "success");

                                } else {
                                    console.log("başarısız");
                                    swal("kayıt Başarısız! ", "", "error");
                                }
                            }
                        }
                    })
                }
        
        function email() {
            var deger = $cikti;
            var url = questions[0].value;
            var isim = questions[1].value;
            var email = questions[2].value;

            let veriler = {
                _token: token,
                email: email,
                deger: deger,
                url: url,
                isim: isim
            };

            console.log(veriler);

            var token = '{{csrf_token()}}';
            axios.post('/sendmail', veriler)
            .then(donen => {
                console.log(donen);
            })
            .catch(console.log);
            /*$.ajax({
                url: '{/{URL::route("sendmail")}}',
                type: 'GET',
                data: {
                    _token: token,
                    email: email,
                    deger: deger,
                    url: url,
                    isim: isim
                },
                dataType: 'JSON',
                success: function (a) {
                    if (a.error) {
                        console.log("eror");
                        alert(a.error);
                    } else {
                        if (a.cevap) {
                            console.log("başarılı");
                            swal("Mail Gönderme Başarılı!", "", "success");

                        } else {
                            console.log("başarısız");
                            swal("Mail Gönderme Başarısız! ", "", "error");
                        }
                    }
                }
            })
        }
        */

        // when all the questions have been answered
        function done() {
            // remove the box if there is no next question
            register.className = 'close'
            @auth

            musteriKayit();
            
            @else


            @endauth


        }

        // when submitting the current question
        function validate() {

            // set the value of the field into the array
            questions[position].value = inputField.value

            // check if the pattern matches
            if (!inputField.value.match(questions[position].pattern || /.+/)) wrong()
            else ok(function () {

                // set the progress of the background
                progress.style.width = ++position * 100 / questions.length + 'vw'

                // if there is a new question, hide current and load next
                if (questions[position]) hideCurrent(putQuestion)
                else hideCurrent(done)

            })

        }

        _geri = function geri() {            
            ok(() => {

                if(position == 1) {
                    geriEl.style.display = "none";
                }

                if(position < 1) {
                    return;
                }

                --position;

                // set the progress of the background
                progress.style.width = position * 100 / questions.length + 'vw'

                // if there is a new question, hide current and load next
                if (questions[position]) hideCurrent(putQuestion)
                else hideCurrent(done)

                inputField.value = questions[position].value;
            });
        }

        // helper
        // --------------

        function hideCurrent(callback) {
            inputContainer.style.opacity = 0
            inputProgress.style.transition = 'none'
            inputProgress.style.width = 0
            setTimeout(callback, wTime)
        }

        function showCurrent(callback) {
            inputContainer.style.opacity = 1
            inputProgress.style.transition = ''
            inputProgress.style.width = '100%'
            setTimeout(callback, wTime)
        }

        function transform(x, y) {
            register.style.transform = 'translate(' + x + 'px ,  ' + y + 'px)'
        }

        function ok(callback) {
            if(position == 0 && geriEl.style.display == "none")
                geriEl.style.display = "block";

            register.className = ''
            setTimeout(transform, tTime * 0, 0, 10)
            setTimeout(transform, tTime * 1, 0, 0)
            setTimeout(callback, tTime * 2)
        }

        function wrong(callback) {
            register.className = 'wrong'
            for (var i = 0; i < 6; i++) // shaking motion
                setTimeout(transform, tTime * i, (i % 2 * 2 - 1) * 20, 0)
            setTimeout(transform, tTime * 6, 0, 0)
            setTimeout(callback, tTime * 7)
        }

    }())
</script>

</html>