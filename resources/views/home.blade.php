@extends('layouts.app')
@section('css')

@endsection

@section('content')
<div class="card">
    <div class="card-content">
        <div id="card-stats" class="row">
            <div class="col s12 m6 xl3">
                <div class="card">
                    <div class="card-content cyan white-text">
                        <p class="card-stats-title"><i class="material-icons">person_outline</i> Kayıtlı Kullanıcı</p>
                        <h4 class="card-stats-number white-text">{{ \App\Musteri::all()->count() }}</h4>

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
                        <h4 class="card-stats-number white-text">{{ \App\Arac::all()->count() }}</h4>

                    </div>
                    <div class="card-action green">
                        <div id="invoice-line" class="center-align"></div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 xl3">
                <div class="card">
                    <div class="card-content red accent-2 white-text">
                        <p class="card-stats-title"><i class="material-icons">attach_money</i>Aylık Ciro</p>
                        <h4 class="card-stats-number white-text">$8990.63</h4>

                    </div>
                    <div class="card-action red">
                        <div id="sales-compositebar" class="center-align"></div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 xl3">
                <div class="card">
                    <div class="card-content orange lighten-1 white-text">
                        <p class="card-stats-title"><i class="material-icons">trending_up</i> Gelişim</p>
                        <h4 class="card-stats-number white-text">$806.52</h4>

                    </div>
                    <div class="card-action orange">
                        <div id="profit-tristate" class="center-align"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col s12 m12 xl2">
                    <canvas id="myChart" width="400" height="400"></canvas>
        </div>
        <div class="col s12 m12 xl2">
                    <canvas id="myChart2" width="400" height="400"></canvas>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('app-assets/vendors/sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('app-assets/vendors/chartjs/chart.min.js') }}"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="{{ asset('app-assets/js/scripts/card-advanced.js') }}" type="text/javascript"></script>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var ctx2 = document.getElementById('myChart2').getContext('2d');
    var data = {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    };
    var data2 = {
        datasets: [{
            data: [10, 20, 30]
        }],

        // These labels appear in the legend and in the tooltips when hovering different arcs
        labels: [
            'Red',
            'Yellow',
            'Blue'
        ]
    };

    var options = {
        responsive: false,
        // scales: {
        //     yAxes: [{
        //         ticks: {
        //             beginAtZero: true
        //         }
        //     }]
        // }
    };

    var myChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });

    var myPieChart = new Chart(ctx2, {
        type: 'pie',
        data: data,
        options: options
    });

</script>
@endsection
