@extends('layouts.app')

@section('css')

@endsection
@section('content')
<div class="row mt-2">

    @foreach ($kullanici as $kul_key => $kul)
    @foreach ($kul->arac as $arac_key => $arac)

    <div class="col s12 m6 l4 card-width">
        <div class="card-panel border-radius-6 mt-10 card-animation-1">
            <div class="center">
                <img class="responsive-img border-radius-8 z-depth-4 image-n-margin" width="225px" height="225px"
                    src="{{$arac->qrCode}}" alt="" />
            </div>
            <div class="col s4 left-align">
                <h6><a href="{{asset('/musterilerim')}}" class="mt-5">{{$arac->Musteri->isimSoyisim}}</a> </h6>
            </div>
            <div class="col s8 right-align">
                <h6><a href="#" class="uppercase">{{str_replace("_", " ", $arac->plaka)}}</a> | {{$arac->marka}} {{$arac->model}} </h6>
            </div>
            <div class="center">
                <a data-target="modal1{{$arac->id}}"
                    class="waves-effect waves-light btn gradient-45deg-light-blue-cyan mt-7 z-depth-4 animated rubberBand faster modal-trigger ">Detay</a>


                <a data-target="modal2{{$arac->id}}"
                    class="waves-effect waves-light btn gradient-45deg-green-teal mt-7 z-depth-4 animated rubberBand faster modal-trigger ">Güncelle</a>

                <a onclick="hizmetEkle({{ $arac->id }})"
                    class="waves-effect waves-light btn blue darken-4 mt-7 z-depth-4 animated rubberBand faster ">
                    <span>Hizmet Ekle</span>
                </a>
            </div>
        </div>
    </div>

    <div id="modal1{{$arac->id}}" class="modal bottom-sheet">
        <div class="modal-content">
            <div class="col s12">
                <div class="col s6">
                    <h4>{{$arac->Musteri->isimSoyisim}}</h4>
                </div>
                <div class="col s6 right-align">
                    <a href="{{asset('/aracDetay/'.$arac->id)}}"
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
        <div class="modal-content">
            {{ csrf_field() }}

            <div class="step-content">
                <div class="row">
                    <div class="input-field col m12 s12">
                        <label for="plaka">Plaka: <span class="red-text">*</span></label>
                        <input type="text" class="validate" value="{{$arac->plaka}}" id="plaka" name="plaka" required>
                    </div>
                    <div class="input-field col m12 s12">
                        <label for="km">Km: <span class="red-text">*</span></label>
                        <input type="text" class="validate" value="{{$arac->km}}" id="km" name="km" required>
                    </div>
                </div>

                <div class="row">
                    <div class="input-field col m12 s12">
                        <select name="marka" id="marka">
                            <option value="{{$arac->marka}}" disabled selected>{{$arac->marka}}
                            </option>
                            @foreach ($markalar as $marka)
                            <option value="{{$marka->name}}">{{$marka->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-field col m12 s12">
                        <select name="aracModel" id="aracModel">
                            <option value="{{$arac->model}}" disabled selected>{{$arac->model}}</option>
                            @foreach ($marka->AracModel as $model)
                            <option value="{{$model->name}}">{{$model->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col m4 s12 mb-1">
                        <button onclick="aracGuncelle({{ $kul_key }}, {{$arac_key}})"
                            class="waves-effect waves-light btn gradient-45deg-green-teal mt-7 z-depth-4 animated rubberBand faster">Güncelle</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endforeach
    @endforeach


</div>
@endsection

@section('js')

<script>
    let a = <?= json_encode($kullanici) ?> ;

    function aracGuncelle(kid, arac_id) {
        console.log(a);
        console.log(a[kid].id);
        console.log(a[kid].arac[arac_id].id);
        let plaka = document.querySelector("#modal2" + a[kid].arac[arac_id].id + " #plaka");
        let km = document.querySelector("#modal2" + a[kid].arac[arac_id].id + " #km");
        let marka = document.querySelector("#modal2" + a[kid].arac[arac_id].id + " #marka");
        let aracModel = document.querySelector("#modal2" + a[kid].arac[arac_id].id + " #aracModel");
        axios.post("/aracGuncelle", {
                km: km.value,
                marka: marka.value,
                aracModel: aracModel.value,
                plaka: plaka.value,
                mid: a[kid].id,
                arac_id: a[kid].arac[arac_id].id
            })
            .then(donen => {
                console.log(donen);
                $('.modal').modal('close', ".modal");
            })
            .catch(error => {
                console.log(error);
            });
    }

    function hizmetEkle(index) {
        location.href = "/hizmet/" + index;
        console.log(index);
    }

</script>


@endsection
