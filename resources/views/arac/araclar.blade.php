@extends('layouts.app')

@section('css')

@endsection

@section('content')
<div style="bottom: 50px; right: 90px;" class="fixed-action-btn direction-top">
        <a class="btn-floating btn-large primary-text gradient-shadow modal-trigger" href="#modal0">
            <i class="material-icons">add_circle_outline</i>
        </a>
    </div>
    
    <div id="modal0" class="modal border-radius-6">
        <div class="modal-content">
            <h5 class="mt-0">Yeni Araç Ekle</h5>
            <hr>
            <div class="row">
                <form class="col s12">
                    <div class="row">
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix"> settings_input_svideo </i>
                            <input id="plaka" type="text" class="validate">
                            <label for="plaka">Plaka</label>
                        </div>
                        <div class="input-field col m6 s12">
                            <i class="material-icons prefix"> settings_input_svideo </i>
                            <input id="km" type="text" class="validate">
                            <label for="km">Km</label>
                        </div>
                    </div>
                    <div class="row">
                            <div class="input-field col m12 s12">
                                <i class="material-icons prefix"> settings_input_svideo </i>
                                <input id="sase" type="text" class="validate">
                                <label for="sase">sase</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix"> settings_input_svideo </i>
                                <input  name="marka" id="marka" type="text" class="validate">
                                <label for="marka">Marka</label>
                            </div>
                            <div class="input-field col m6 s12">
                                <i class="material-icons prefix"> settings_input_svideo </i>
                                <input  name="aracModel" id="aracModel" type="text" class="validate">
                                <label for="aracModel">Model</label>
                            </div>
                        </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
                <button onclick="aracEkle()" class="btn modal-close waves-effect waves-light mr-2">Araç Ekle</button>
        </div>
    </div>
<div class="row mt-2">

    @foreach ($kullanici as $kul_key => $kul)
    @foreach ($kul->arac as $arac_key => $arac)
    <div id="modal0{{$arac->id}}" class="modal border-radius-6">
            <div class="modal-content">
                
                <hr>
                <div class="row">
                   
                        
                            <div class="input-field col m6 s12">
                                <h4 class="validate">{{$arac->plaka}} Plakalı Aracı Silmek İstediğinden Emin Misin ?</h4>
                                
                            </div>
                            
                      
                      
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn modal-close waves-effect waves-light mr-1">İptal</button>
                <button onclick="aracSil({{$arac->id}})" class="btn modal-close waves-effect waves-light mr-2">Arac Sil</button>
            </div>
    </div>
    <div id="ar{{$arac->Musteri->id}}" class="col s12 m6 l4 card-width">
        <div class="card-panel border-radius-6 mt-10 card-animation-1">
            <div class="center">
                <img class="responsive-img border-radius-8 z-depth-4 image-n-margin" width="225px" height="225px"
                    src="{{$arac->qrCode}}" alt="" />
            </div>
            <div class="col s4 left-align">
                <h6><a href="{{asset('/musterilerim')}}" class="mt-5">{{$arac->Musteri->isimSoyisim}}</a> </h6>
            </div>
            <div class="col s8 right-align">
                <h6><a href="#" class="uppercase">{{$arac->plaka}}</a> | {{$arac->marka}} {{$arac->model}} </h6>
            </div>
            <div class="center">
                <a data-target="modal1{{$arac->id}}"
                    class="waves-effect waves-light btn gradient-45deg-light-blue-cyan mt-7 z-depth-4  modal-trigger ">Detay</a>


                <a data-target="modal2{{$arac->id}}"
                    class="waves-effect waves-light btn gradient-45deg-green-teal mt-7 z-depth-4  modal-trigger ">Güncelle</a>

                <a onclick="hizmetEkle({{ $arac->id }})"
                    class="waves-effect waves-light btn blue darken-4 mt-7 z-depth-4  ">
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
                        <a data-target="modal0{{$arac->id}}"
                                class="mb-6 btn waves-effect waves-light red accent-2 modal-trigger ">Sil</a>
                    <a href="{{asset('/aracDetay/'.$arac->plaka)}}"
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
                        
                        <input  name="marka" value="{{$arac->marka}}" id="marka" type="text" class="validate">
                        <label for="marka">Marka</label>
                    </div>
                    <div class="input-field col m12 s12">
                        
                        <input  name="aracModel" value="{{$arac->model}}" id="aracModel" type="text" class="validate">
                        <label for="aracModel">Model</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col m4 s12 mb-1">
                        <button onclick="aracGuncelle({{ $kul_key }}, {{$arac_key}})"
                            class="waves-effect waves-light btn gradient-45deg-green-teal mt-7 z-depth-4 ">Güncelle</button>
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
               
                $('.modal').modal('close', ".modal");
                M.toast({html: 'İşlem başarılı!', classes: "green"});
            })
            .catch(error => {
                console.log(error);
                M.toast({html: 'İşlem sırasında bir hata oluştu!', classes: "red"});
            });
    }
    function aracEkle() {
        let token = '{{csrf_token()}}';
       
        let plaka = document.querySelector("#modal0 #plaka").value;
        let km = document.querySelector("#modal0 #km").value;
        let sase = document.querySelector("#modal0 #sase").value;
        let marka = document.querySelector("#modal0 #marka").value;
        let aracModel = document.querySelector("#modal0 #aracModel").value;

        axios.post("/aracEkle", {
                token: token,
                plaka: plaka,
                km: km,
                sase: sase,
                marka: marka,
                aracModel: aracModel
            })
            .then(res => {
                
                $('.modal0').modal('close', ".modal0");
                M.toast({html: 'İşlem başarılı!', classes: "green"});
            })
            .catch(er => {
                M.toast({html: 'İşlem sırasında bir hata oluştu!', classes: "red"});
                
            });
    }
    function aracSil(aid) {
        let token = '{{csrf_token()}}';
        axios.post("/aracSil", {
                token: token,
                aid: aid,
            })
            .then(res => {
                
                $('.modal').modal('close', ".modal");
                M.toast({html: 'İşlem başarılı!', classes: "green"});
                document.getElementById("ar"+aid).remove();
            })
            .catch(er => {
                M.toast({html: 'İşlem sırasında bir hata oluştu!', classes: "red"});
                
            });
    }
    function hizmetEkle(index) {
        location.href = "/hizmet/" + index;
        console.log(index);
    }

</script>


@endsection
