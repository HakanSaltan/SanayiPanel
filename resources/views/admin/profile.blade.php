@extends('layouts.app')
@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/user-profile-page.css')}}">
@endsection

@section('content')
<img class="responsive-img" alt="" src="{{asset('app-assets/images/gallery/profile-bg.png')}}">
</div>
<div class="section" id="user-profile">
  <div class="row">
    <!-- User Profile Feed -->
    <div class="col s12 m4 l3 user-section-negative-margin">
      <div class="row">
        <div class="col s12 center-align">
          <img class="responsive-img circle z-depth-5" width="200" src="{{asset('app-assets/images/user/12.jpg')}}" alt="">
          <a href="#" class="waves-effect waves-light btn-small mb-1">Parola Değiştir</a>
          <br>
          
        </div>
      </div>
      <div class="row mt-5">
        <div class="col s6">
          <h6>Gerçekleşen Hizmet Sayısı</h6>
          <h5 class="m-0"><a href="#">2</a></h5>
        </div>
        <div class="col s6">
          <h6>Serviste Bulunan Araç Sayısı</h6>
          <h5 class="m-0"><a href="#">2</a></h5>
        </div>
      </div>
      
      
      <hr>
      <div class="row user-projects">
        <h6 class="col s12">Galeri</h6>
        <div class="col s4">
          <img class="responsive-img photo-border mt-10" alt="" src="{{asset('app-assets/images/gallery/35.png')}}">
        </div>
        <div class="col s4">
          <img class="responsive-img photo-border mt-10" alt="" src="{{asset('app-assets/images/gallery/36.png')}}">
        </div>
        <div class="col s4">
          <img class="responsive-img photo-border mt-10" alt="" src="{{asset('app-assets/images/gallery/37.png')}}">
        </div>
        <div class="col s4">
          <img class="responsive-img photo-border mt-10" alt="" src="{{asset('app-assets/images/gallery/38.png')}}">
        </div>
        <div class="col s4">
          <img class="responsive-img photo-border mt-10" alt="" src="{{asset('app-assets/images/gallery/39.png')}}">
        </div>
        <div class="col s4">
          <img class="responsive-img photo-border mt-10" alt="" src="{{asset('app-assets/images/gallery/40.png')}}">
        </div>
        <div class="col s4">
          <img class="responsive-img photo-border mt-10" alt="" src="{{asset('app-assets/images/gallery/41.png')}}">
        </div>
        <div class="col s4">
          <img class="responsive-img photo-border mt-10" alt="" src="{{asset('app-assets/images/gallery/42.png')}}">
        </div>
        <div class="col s4">
          <img class="responsive-img photo-border mt-10" alt="" src="{{asset('app-assets/images/gallery/43.png')}}">
        </div>
      </div>
      <hr class="mt-5">
      <div class="row">
        <div class="col s12">
          <h6>Çalışanlar</h6>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col s2 mt-2 pr-0 circle pb-2">
          <a href="#"><img class="responsive-img circle" src="{{asset('app-assets/images/user/8.jpg')}}" alt=""></a>
        </div>
        <div class="col s9">
          <a href="#">
            <p class="m-0">Wiley J. Bryant</p>
          </a>
        </div>
      </div>
    </div>
    <!-- User Post Feed -->
    <div class="col s9">
      <div class="row">
        <div class="card user-card-negative-margin z-depth-0" id="feed">
          <div class="card-content card-border-gray">
            <div class="row">
              <div class="col s12">
              <h5>{{$kullanici[0]->name}} </h5> 
              </div>
            </div>        
            <hr class="mt-5">
            <div class="row mt-5">
              <div class="col s1 pr-0 circle">
                <a href="#"><img class="responsive-img circle" src="{{asset('app-assets/images/user/7.jpg')}}" alt=""></a>
              </div>
              <div class="col s11">
                <a href="#">
                  <p class="m-0">{{$kullanici[0]->name}}</p>
                </a>
                <div class="row">
                  <div class="col s12">
                    <div class="card card-border z-depth-2">
                      <div class="card-content">
                        <h6 class="font-weight-900 text-uppercase"><a href="#">Auid R8 Araç Kapı İşi</a></h6>
                        <p>Servise Gelen Kapı Giderildi</p>
                      </div>
                    </div>
                   </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Today Highlight -->
    
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