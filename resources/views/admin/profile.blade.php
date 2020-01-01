@extends('layouts.app')
@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/user-profile-page.css')}}">
@endsection
<?php 
    $ayarlar =\App\userAyar::where('user_id','=', Auth::user()->id)->get();
    $ayar = $ayarlar[0]->ayarJSON;
    $ayar = json_decode($ayar);
 ?>
@section('content')

<div class="card card-default scrollspy">
    <div class="card-content">
        <div class="section">

            <div class="col s12 m12 l12 user-section-negative-margin">
                <div class="row">
                    <div class="col s12 center-align">
                        @if (isset($ayar))
                            @if (isset($ayar->firma_logo->yol))
                            <img class="mb-2 width-40" src="{{asset($ayar->firma_logo->yol)}}" alt="company logo">
                            @else
                            <img class="responsive-img circle z-depth-5" width="200"
                                src="{{asset('app-assets/images/user/1.jpg')}}" alt="">
                            @endif
                            <br><hr>
                            <div class="col s12 m12 l12">
                            
                                <h6>{{$ayar->firma_adi}} </h6>
                                <p>Adres :{{$ayar->firma_adresi}} </p>
                                <p>Telefon No :{{$ayar->firma_telefon}}</p>
                            </div>
                        @endif
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
