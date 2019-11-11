@extends('layouts.app')
@section('css')

@endsection

@section('content')

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
                <p class="card-stats-title"><i class="material-icons">directions_car</i>Toplam Alınan Servis</p>
                <h4 class="card-stats-number white-text">{{ \App\Islemler::all()->count() }}</h4>

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
                <h4 class="card-stats-number white-text">₺
                     @foreach (DB::table('Fatura')->pluck('toplamUcret') as $toplam)
                         <?= $toplam = $toplam + $toplam ?>
                     @endforeach
                    
                </h4>

            </div>
            <div class="card-action orange">
                <div id="profit-tristate" class="center-align"></div>
            </div>
        </div>
    </div>

</div>
</div>
<div class="row">
    <div class="col s12 m6 fadeLeft">
        <div class="container">
            <div class="card">
                <div class="card-move-up waves-effect waves-block waves-dark">
               <div class="move-up cyan darken-1">
                  <div>
                     <span class="chart-title white-text">Durum</span>
                     <div class="chart-revenue cyan darken-2 white-text">
                        <p class="chart-revenue-total">4,500.85  ₺</p>
                        <p class="chart-revenue-per"><i class="material-icons">arrow_drop_up</i> 21.80 %</p>
                     </div>
                     <div class="switch chart-revenue-switch right">
                        <label class="cyan-text text-lighten-5">
                           Month <input type="checkbox"> <span class="lever"></span> Year
                        </label>
                     </div>
                  </div>
                  <div class="revenue-line-chart-wrapper"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div><canvas id="revenue-line-chart" height="145" width="622" class="chartjs-render-monitor" style="display: block; width: 622px; height: 145px;"></canvas></div>
               </div>
            </div>
            </div>
        </div>
    </div>
    <div class="col s12 m6 fadeRight">
        <div class="container">
            <div class="card">
                <div class="sample-chart-wrapper"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div><canvas id="line-chart" height="400" width="951" class="chartjs-render-monitor" style="display: block; width: 951px; height: 400px;"></canvas></div>
            </div>
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
    @endsection
