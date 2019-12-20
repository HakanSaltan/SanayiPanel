<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
        <div id="progress"></div>
        <div class="kg-main">
            <div class="center">
                <div id="register">
        
                    <i id="progressButton" class="ion-android-arrow-forward next"></i>
        
                    <div id="inputContainer">
                        <input id="inputField" onkeyup="plakaTest()" required autofocus />
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
    function plakaTest() {
        var x = document.getElementById("inputField");
        x.value = x.value.replace(/[^a-zA-Z0-9]/g, "").toUpperCase().trim();
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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
                if(!res.data.sonuc)
                    return console.log("hata");

                if(res.data.parametreler.location)
                    location.href = res.data.parametreler.location;
                else
                    location.href = "/home";
            })
            .catch(er => {
                console.log(er);
            });
        }
        
        function aracDetay() {
         let token = '{{csrf_token()}}';
         let plaka = questions[0].value;
         axios.post("/plakaKontrol", {
                token: token,
                plaka: plaka,
            })
            .then(res => {
                location.href = "/aracDetay/"+plaka;   
            })
            .catch(er => {
                console.log(er);
              
            });
        
          
        }

        function done() {
            
            register.className = 'close'
            @auth
            musteriKayit();
            @else
            aracDetay();
            @endauth


        }

     
        function validate() {

            
            questions[position].value = inputField.value

           
            if (!inputField.value.match(questions[position].pattern || /.+/)) wrong()
            else ok(function () {

           
                progress.style.width = ++position * 100 / questions.length + 'vw'

             
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

               
                progress.style.width = position * 100 / questions.length + 'vw'

              
                if (questions[position]) hideCurrent(putQuestion)
                else hideCurrent(done)

                inputField.value = questions[position].value;
            });
        }


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
            for (var i = 0; i < 6; i++) 
                setTimeout(transform, tTime * i, (i % 2 * 2 - 1) * 20, 0)
            setTimeout(transform, tTime * 6, 0, 0)
            setTimeout(callback, tTime * 7)
        }

    }())
</script>

</html>