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
        
</div>
@endsection

@section('js')
<script src="{{ asset('app-assets/vendors/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/chartjs/chart.min.js') }}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ asset('app-assets/js/scripts/card-advanced.js') }}" type="text/javascript"></script>
@endsection