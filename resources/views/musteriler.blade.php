@extends('layouts.app')

@section('css')

@endsection
@section('content')
<div class="row">
    @foreach ($kullanicilar as $kullanici)


    <div class="col s12 m6 l4 card-width">
        <div class="card card-border center-align gradient-45deg-indigo-light-blue ">
            <div class="card-content white-text">

                <img class="responsive-img circle z-depth-4" width="100" src="{{asset('app-assets/images/user/2.jpg')}}"
                    alt="" />
                <h5 class="white-text mb-1">{{$kullanici->isimSoyisim}}</h5>
                <p class="m-0">Sakarya</p>
                <p class="mt-8">
                    {{$kullanici->adres}}
                </p>
                <a data-target="modal1{{$kullanici->id}}"
                    class="waves-effect waves-light btn gradient-45deg-green-teal border-round mt-7 z-depth-4 animated rubberBand faster modal-trigger ">Detay</a>
                <a data-target="modal2{{$kullanici->id}}"
                    class="waves-effect waves-light btn gradient-45deg-amber-amber border-round mt-7 z-depth-4 animated rubberBand faster modal-trigger ">Güncelle</a>

            </div>
        </div>
    </div>

    <div id="modal1{{$kullanici->id}}" class="modal bottom-sheet">
        <div class="modal-content">
            <h4>{{$kullanici->isimSoyisim}}</h4>
            <p>1</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Güncelle</a>
        </div>
    </div>
    <div id="modal2{{$kullanici->id}}" class="modal bottom-sheet">
        <div class="modal-content">
            <form id="musteriGuncelle" @submit="musteriGuncelle">
                <ul>
                    <li>
                        <div class="step-title waves-effect">Kullanıcı Bilgileri</div>
                        <div class="step-content">
                            <div class="row">
                                <div class="input-field col m6 s12">
                                    <label for="isimSoyisim">İsim Soyisim: <span class="red-text">*</span></label>
                                    <input type="text" id="isimSoyisim" value="{{$kullanici->isimSoyisim}}"
                                        name="isimSoyisim" v-model="isimSoyisim" class="validate" required>
                                </div>
                                <div class="input-field col m6 s12">
                                    <label for="telefon">Telefon Numarası: <span class="red-text">*</span></label>
                                    <input type="number" class="validate" value="{{$kullanici->telefon}}" name="telefon"
                                        id="telefon" v-model="telefon" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col m6 s12">
                                    <label for="tc">Tc: <span class="red-text">*</span></label>
                                    <input type="number" id="tc" value="{{$kullanici->tc}}" name="tc" v-model="tc" class="validate"
                                        required>
                                </div>
                                <div class="input-field col m6 s12">
                                    <label for="adres">Adres: <span class="red-text">*</span></label>
                                    <input type="text" class="validate" value="{{$kullanici->adres}}" name="adres" v-model="adres"
                                        id="adres" required>
                                </div>

                            </div>
                            <div>
                                <div class="row">
                                    <div class="col m6 s12 mb-1">
                                        <button class="waves-effect waves-light btn gradient-45deg-amber-amber border-round mt-7 z-depth-4 animated rubberBand faster modal-trigger"
                                            type="submit">Güncelle</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </form>
        </div>
    </div>

    @endforeach
</div>


@endsection

@section('js')

<script>
function musteriGuncelle() {
            let token = '{{csrf_token()}}';
            let telefon = telefon.value;
            let isimSoyisim = isimSoyisim.value;
            let tc = tc.value;
            let adres = adres.value;


            axios.post("/musteriGuncelle/"+ kullanici->id, {
                token: token,
                telefon: telefon,
                isimSoyisim: isimSoyisim,
                tc: tc,
                adres: adres
            })
            .then(res => {
                console.log("başarılı "+ res);
            })
            .catch(er => {
                console.log("başarısız "+ er);
            });
        }
</script>

@endsection
