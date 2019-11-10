@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/form-wizard.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('app-assets/vendors/materialize-stepper/materialize-stepper.min.css')}}">
@endsection
@section('content')
<div class="row mt-2">

    
        @foreach ($kullanici->Arac as $arac)

        <div class="col s12 m6 l4 card-width">
            <div class="card-panel border-radius-6 mt-10 card-animation-1">

                <div class="resimKapsayici">
                    <img class="responsive-img border-radius-8 z-depth-4 image-n-margin"
                        src="{{asset('app-assets/images/cards/plaka2.jpg')}}" alt="" />
                    <h1 class="resimYazisi image-n-margin">{{str_replace("_", " ", $arac->plaka)}}</h1>
                </div>
                <h6><a href="#" class="mt-5">{{$kullanici->isimSoyisim}}</a></h6>

                <p>{{$arac->marka}} {{$arac->model}} modelindeki Araç {{$arac->km}} km dedir.</p>

                <a data-target="modal1{{$arac->id}}"
                    class="waves-effect waves-light btn gradient-45deg-light-blue-cyan border-round mt-7 z-depth-4 animated rubberBand faster modal-trigger ">Detay</a>


                <a data-target="modal2{{$kullanici->id}}"
                    class="waves-effect waves-light btn gradient-45deg-green-teal border-round mt-7 z-depth-4 animated rubberBand faster modal-trigger ">Güncelle</a>

            </div>
        </div>

        <div id="modal1{{$arac->id}}" class="modal bottom-sheet">
            <div class="modal-content">
                <div class="col s12">
                    <div class="col s6">
                        <h4>{{$kullanici->isimSoyisim}}</h4>
                    </div>
                    <div class="col s6 right-align">
                        <a href="{{asset('/arac-detay/'.$arac->id)}}"
                            class="mb-6 btn waves-effect waves-light gradient-45deg-light-blue-cyan">Tüm Detaylar</a>
                    </div>

                </div>

                <div class="row">
                    <div class="col s12 m6 l3 card-width">
                        <div class="card border-radius-6">
                            <div class="card-content center-align">
                                <i class="material-icons amber-text small-ico-bg mb-5">near_me</i>
                                <h4 class="m-0"><b>{{$arac->km}}</b></h4>
                                <p>Araç Kilometresi</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3 card-width">
                        <div class="card border-radius-6">
                            <div class="card-content center-align">
                                <i class="material-icons amber-text small-ico-bg mb-5">directions_car</i>
                                <h4 class="m-0"><b>{{$arac->marka}}</b></h4>
                                <p>Araç Markası</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3 card-width">
                        <div class="card border-radius-6">
                            <div class="card-content center-align">
                                <i class="material-icons amber-text small-ico-bg mb-5">eject</i>
                                <h4 class="m-0"><b>{{$arac->model}}</b></h4>
                                <p>Araç Modeli</p>
                            </div>
                        </div>
                    </div>
                    <div class="col s12 m6 l3 card-width">
                        <div class="card border-radius-6">
                            <div class="card-content center-align">
                                <i class="material-icons amber-text small-ico-bg mb-5">access_time</i>
                                <h4 class="m-0"><b>{{substr($arac->created_at,0,10)}}</b></h4>
                                <p>Servis Giriş Tarihi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>

        <div id="modal2{{$arac->id}}" class="modal">
            <form role="form" method="post" action="{{asset('/aracGuncelle'.'/'.$arac->id.'/'.$kullanici->id)}}">
                <div class="modal-content">
                    {{ csrf_field() }}
                    <div class="step-title waves-effect">Araç Bilgileri = <img class="qr-code" src="{{$arac->qrCode}}"
                            alt="qr-code"></div>
                    <div class="step-content">
                        <div class="row">
                            <div class="input-field col m12 s12">
                                <label for="plaka">Plaka: <span class="red-text">*</span></label>
                                <input type="text" class="validate" value="{{$arac->plaka}}" id="plaka" name="plaka"
                                    required>
                            </div>
                            <div class="input-field col m12 s12">
                                <label for="km">Km: <span class="red-text">*</span></label>
                                <input type="text" class="validate" value="{{$arac->km}}" id="km" name="km" required>
                            </div>
                        </div>
                        @if(!empty($markalar[0]))
                        <div class="row">
                            <div class="input-field col m12 s12">
                                <select name="marka" id="marka">
                                    <option value="{{$arac->model}}" disabled selected>{{$arac->model}}
                                    </option>
                                    @foreach ($markalar as $marka)
                                    <option value="{{$marka->marka}}">{{$marka->marka}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-field col m12 s12">
                                <select name="aracModel" id="aracModel">
                                    <option value="{{$arac->marka}}" disabled selected>Model</option>
                                    @foreach ($marka->AracModel as $model)
                                    <option value="{{$model->model}}">{{$model->model}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col m4 s12 mb-1">
                                <button
                                    class="waves-effect waves-light btn gradient-45deg-green-teal border-round mt-7 z-depth-4 animated rubberBand faster modal-trigger"
                                    type="submit">Güncelle</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @endforeach

    
</div>
@endsection

@section('js')
<script src="{{asset('app-assets/vendors/materialize-stepper/materialize-stepper.min.js')}}"></script>
<script src="{{asset('app-assets/js/scripts/form-wizard.js')}}" type="text/javascript"></script>
<style>
    .resimKapsayici {
        position: relative
    }

    .resimYazisi {
        position: absolute;
        left: 15%;
        top: 50%;
        font-size: 3.5vw;
    }

    .qr-code {
        width: 200px;
        height: 200px;
    }

</style>
<script>
    $("#aracModel").hide();
    $("#aracModel").css('display', "none");
    $("#marka").on("change", function (e) {
        $("#aracModel").css('display', "block");
    });

</script>
@endsection