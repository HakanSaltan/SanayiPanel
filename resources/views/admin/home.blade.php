@extends('layouts.app')
@section('css')


@endsection

@section('content')
<?php
$Musteriler = \App\Musteri::where('user_id',Auth::user()->id)->get();
$araclar = \App\Arac::where('musteri_id',"0")->get();
?>
<div id="card-stats" class="row">
    <div class="col s12 m6 xl3">
        <div class="card">
            <div class="card-content cyan white-text">
                <p class="card-stats-title"><i class="material-icons">person_outline</i> Kayıtlı Kullanıcı</p>
                <h4 class="card-stats-number white-text">
                    {{ $toplamMusteri }}
                </h4>

            </div>
            <div class="card-action cyan darken-1">
                <div id="clients-bar" class="center-align"></div>
            </div>
        </div>
    </div>
    <div class="col s12 m6 xl3">
        <div class="card">
            <div class="card-content green lighten-1 white-text">
                <p class="card-stats-title"><i class="material-icons">settings_input_svideo</i> Kayıtlı Araç</p>
                <h4 class="card-stats-number white-text">
                    {{ $toplamKayitliArac }}
                </h4>

            </div>
            <div class="card-action green">
                <div id="invoice-line" class="center-align"></div>
            </div>
        </div>
    </div>
    <div class="col s12 m6 xl3">
        <div class="card">
            <div class="card-content red accent-2 white-text">
                <p class="card-stats-title"><i class="material-icons">directions_car</i>Toplam Alınan Servis</p>
                <h4 class="card-stats-number white-text">
                    {{ $toplamYapilanHizmet }}
                </h4>

            </div>
            <div class="card-action red">
                <div id="sales-compositebar" class="center-align"></div>
            </div>
        </div>
    </div>
    <div class="col s12 m6 xl3">
        <div class="card">
            <div class="card-content orange lighten-1 white-text">
                <p class="card-stats-title"><i class="material-icons">trending_up</i> Toplam Ciro</p>
                <h4 class="card-stats-number white-text">
                    <?= is_numeric($toplamCiro) && floatval($toplamCiro) > 0 ? $toplamCiro : 0 ?> ₺
                </h4>
            </div>
            <div class="card-action orange">
                <div id="profit-tristate" class="center-align"></div>
            </div>
        </div>
    </div>

</div>
<div class="row card">
        <div class="card-content">
                <h4 class="card-title">Müşteriye Araç Ata</h4>
        <div class="input-field col m4 s12">
            <select name="mid" id="mid">
                <option value="" disabled selected>Lütfen Müşteri Seçiniz
                </option>
                @foreach ($Musteriler as $musteri)
                <option value="{{$musteri->id}}">{{$musteri->isimSoyisim}}</option>
                @endforeach
            </select>
        </div>
        <div class="input-field col m4 s12">
            <select name="arac_id" id="arac_id">
                <option value="" disabled selected>Lütfen Araç Seçiniz</option>
                @foreach ($araclar as $arac)
                <option value="{{$arac->id}}">{{$arac->plaka}}</option>
                @endforeach
            </select>
        </div>
        <div class="input-field large col m4 s12">
        <button onclick="musteriArac()" class="btn modal-close waves-effect waves-light mr-2">Kaydet</button>
        </div>
    </div>
</div>

<div class="row">
    <div id="chartjs-bar-chart" class="card">
        <div class="card-content">
            <h4 class="card-title">Gelir - Gider Tablosu</h4>
            <div class="row">
                <div class="col s12">
                    <p class="mb-2">

                    </p>
                    <div class="sample-chart-wrapper"><canvas id="bar-chart" width="400" height="400"></canvas></div>
                </div>
            </div>
        </div>
    </div>

</div>


@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js" integrity="sha256-qSIshlknROr4J8GMHRlW3fGKrPki733tLq+qeMCR05Q=" crossorigin="anonymous"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script> -->
<!-- <script src="{{ asset('app-assets/vendors/chartjs/chart.js') }}"></script> -->
<!-- <script src="{{ asset('app-assets/js/scripts/card-advanced.js') }}" type="text/javascript"></script> -->
<script>
        function musteriArac() {
            let token = '{{csrf_token()}}';
           
            let mid = document.querySelector("#mid").value;
            let arac_id = document.querySelector("#arac_id").value;
            
            axios.post("/musteriArac", {
                    token: token,
                    mid: mid,
                    arac_id: arac_id
                })
                .then(res => {
                    console.log("başarılı " + res);
                    M.toast({html: 'İşlem başarılı!', classes: "green"});
                   
                })
                .catch(er => {
                    M.toast({html: 'İşlem sırasında bir hata oluştu!', classes: "red"});
                    console.log("başarısız " + er);
                });
        }
    </script>
<script>
    var chartVerileri = "";
    $(window).on("load", function () {
        
        chartVerileri = <?= $chartVerileri ?>;

        let aylar = ["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"];

        let hazirlananVeriler = Array(aylar.length).fill(0);

        Object.keys(chartVerileri).forEach(item => {
            hazirlananVeriler[parseInt(item) - 1] = chartVerileri[item];
        });
        //Get the context of the Chart canvas element we want to select
        var ctx = $("#bar-chart");

        // Chart Options
        var chartOptions = {
            // Elements options apply to all of the options unless overridden in a dataset
            // In this case, we are setting the border of each horizontal bar to be 2px wide and green
            elements: {
                rectangle: {
                    borderWidth: 2,
                    borderColor: "rgb(0, 255, 0)",
                    borderSkipped: "left"
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            responsiveAnimationDuration: 500,
            legend: {
                position: "top"
            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        color: "#f3f3f3",
                        drawTicks: false
                    },
                    scaleLabel: {
                        display: true
                    }
                }],
                yAxes: [{
                    display: true,
                    gridLines: {
                        color: "#f3f3f3",
                        drawTicks: false
                    },
                    scaleLabel: {
                        display: true
                    }
                }]
            },
            title: {
                display: true,
                text: "Aylık Gelir - Giderlerinizi Buradan Görebilirsiniz"
            }
        };

        // Chart Data
        var chartData = {
            labels: aylar,
            datasets: [
                {
                    label: "Gelir",
                    data: hazirlananVeriler,
                    backgroundColor: "#66bb6a",
                    hoverBackgroundColor: "#4caf50",
                    borderColor: "transparent"
                },
                // {
                //     label: "Gider",
                //     data: [28, 48, 40, 19, 28, 48, 40, 19, 28, 48],
                //     backgroundColor: "#ff5252",
                //     hoverBackgroundColor: "#f44336",
                //     borderColor: "transparent"
                // }
            ]
        };

        var config = {
            type: "bar",

            // Chart Options
            options: chartOptions,

            data: chartData
        };

        // Create the chart
        var barChart = new Chart(ctx, config);
    });

</script>

@endsection
