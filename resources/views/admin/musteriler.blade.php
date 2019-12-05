@extends('layouts.app')

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-sidebar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-contacts.css') }}">
@endsection
@section('content')

<div style="bottom: 50px; right: 90px;" class="fixed-action-btn direction-top">
    <a class="btn-floating btn-large primary-text gradient-shadow modal-trigger" href="#modal0">
        <i class="material-icons">person_add</i>
    </a>
</div>

<div id="modal0" class="modal border-radius-6">
    <div class="modal-content">
        <h5 class="mt-0">Yeni Müşteri Ekle</h5>
        <hr>
        <div class="row">
            <form class="col s12">
                <div class="row">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix"> perm_identity </i>
                        <input id="isimSoyisim" type="text" class="validate">
                        <label for="isimSoyisim">Ad Soyad</label>
                    </div>
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix"> business </i>
                        <input id="tc" type="text" class="validate">
                        <label for="tc">Tc</label>
                    </div>
                </div>
                <div class="row">

                    <div class="input-field col s12">
                        <i class="material-icons prefix"> call </i>
                        <input id="telefon" type="number" class="validate">
                        <label for="telefon">Telefon</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix"> note </i>
                        <input id="adres" type="text" class="validate">
                        <label for="adres">Adres</label>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="modal-footer">
            <button onclick="musteriEkle()" class="btn modal-close waves-effect waves-light mr-2">Müşteri Ekle</button>
    </div>
</div>

<div class="sidebar-left sidebar-fixed">
    <div class="sidebar">
        <div class="sidebar-content">
            <div class="sidebar-header">
                <div class="sidebar-details">
                    <h5 class="m-0 sidebar-title"><i class="material-icons app-header-icon text-top">perm_identity</i>
                        Müşteriler
                    </h5>
                    <div class="mt-10 pt-2">
                        <p class="m-0 subtitle font-weight-700">Toplam Müşteri</p>
                        <p class="m-0 text-muted">{{ \App\Musteri::where('user_id',Auth::user()->id)->count() }}</p>
                    </div>
                </div>
            </div>
            <div id="sidebar-list" class="sidebar-menu list-group position-relative animate fadeLeft delay-1">
                <div class="sidebar-list-padding app-sidebar sidenav" id="contact-sidenav">
                    <ul class="contact-list display-grid">
                        <li class="sidebar-title">Kişiler</li>
                        <li class="active"><a href="#!" class="text-sub"><i class="material-icons mr-2">
                                    perm_identity </i> Tüm Kişiler</a></li>
                        <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> star_border </i>
                                Favoriler</a></li>
                        <li class="sidebar-title">Tümünü Yazdır</li>
                        <li><a href="#!" class="text-sub"><i class="material-icons mr-2"> print </i> Print</a></li>
                    </ul>
                </div>
            </div>
            <a href="#" data-target="contact-sidenav" class="sidenav-trigger hide-on-large-only"><i
                    class="material-icons">menu</i></a>
        </div>
    </div>
</div>
<div class="content-area content-right">
    <div class="app-wrapper">
        <div class="datatable-search">
            <i class="material-icons mr-2 search-icon">search</i>
            <input type="text" placeholder="Müşteri Ara" class="app-filter" id="global_filter">
        </div>
        <div id="button-trigger" class="card card card-default scrollspy border-radius-6 fixed-width">
            <div class="card-content p-0">
                <table id="data-table-contact" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th class="background-image-none center-align">
                                <label>
                                    <input type="checkbox" onClick="toggle(this)" />
                                    <span></span>
                                </label>
                            </th>
                            <th>İsim Soyisim</th>
                            <th>Telefon</th>
                            <th>Tc</th>
                            <th>Adres</th>
                            <th>Güncelle</th>
                            <th>Sil</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kullanicilar as $kullanici)
                        <tr id="tr{{$kullanici->id}}">
                            <td class="center-align">
                                <label>
                                    <input type="checkbox" name="foo" />
                                    <span></span>
                                </label>
                            </td>
                            <td>{{$kullanici->isimSoyisim}}</td>
                            <td>{{$kullanici->telefon}}</td>
                            <td>{{$kullanici->tc}}</td>
                            <td>{{$kullanici->adres}}</td>
                            <td><a data-target="modal1{{$kullanici->id}}"
                                    class="waves-effect waves-light btn gradient-45deg-light-blue-cyan mt-7 z-depth-4  modal-trigger ">Güncelle</a></td>
                            
                            
                            
                            <td><a data-target="modal2{{$kullanici->id}}" class="btn waves-effect waves-light red accent-2 modal-trigger ">Sil</a>

                        </tr>
                        <div id="modal1{{$kullanici->id}}" class="modal border-radius-6">
                            <div class="modal-content">
                                <h5 class="mt-0">{{$kullanici->isimSoyisim}} Ad'lı Müşteriyi Güncelle</h5>
                                <hr>
                                <div class="row">
                                    <form class="col s12">
                                        <div class="row">
                                            <div class="input-field col m6 s12">
                                                <i class="material-icons prefix"> perm_identity </i>
                                                <input id="isimSoyisim" type="text" value="{{$kullanici->isimSoyisim}}"
                                                    class="validate">
                                                <label for="isimSoyisim">Ad Soyad</label>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <i class="material-icons prefix"> business </i>
                                                <input id="tc" type="text" value="{{$kullanici->tc}}"
                                                    class="validate">
                                                <label for="tc">Tc</label>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="input-field col s12">
                                                <i class="material-icons prefix"> call </i>
                                                <input id="telefon" type="number" value="{{$kullanici->telefon}}"
                                                    class="validate">
                                                <label for="telefon">Telefon</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix"> note </i>
                                                <input id="adres" type="text" value="{{$kullanici->adres}}"
                                                    class="validate">
                                                <label for="adres">Adres</label>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button onclick="musteriGuncelle({{$kullanici->id}})" class="btn modal-close waves-effect waves-light mr-2">Müşteri Güncelle</button>
                            </div>
                        </div>
                        <div id="modal2{{$kullanici->id}}" class="modal border-radius-6">
                            <div class="modal-content">
                                
                                <hr>
                                <div class="row">
                                   
                                        
                                            <div class="input-field col m6 s12">
                                                <h4 class="validate">{{$kullanici->isimSoyisim}} Adlı Kullanıcıyı Silmek İstediğinden Emin Misin ?</h4>
                                                
                                            </div>
                                            
                                      
                                      
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn modal-close waves-effect waves-light mr-1">İptal</button>
                                <button onclick="musteriSil({{$kullanici->id}})" class="btn modal-close waves-effect waves-light red accent-2">Müşteri Sil</button>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection

@section('js')
<script src="{{ asset('app-assets/js/scripts/app-contacts.js')}}" type="text/javascript"></script>
<script>
    function musteriGuncelle(kid) {
        let token = '{{csrf_token()}}';
       
        let telefon = document.querySelector("#modal1" + kid + " #telefon").value;
        let isimSoyisim = document.querySelector("#modal1" + kid + " #isimSoyisim").value;
        let tc = document.querySelector("#modal1" + kid + " #tc").value;
        let adres = document.querySelector("#modal1" + kid + " #adres").value;
        axios.post("/musteriGuncelle", {
                token: token,
                kid: kid,
                telefon: telefon,
                isimSoyisim: isimSoyisim,
                tc: tc,
                adres: adres
            })
            .then(res => {
                console.log("başarılı " + res);
                $('.modal').modal('close', ".modal");
                M.toast({html: 'İşlem başarılı!', classes: "green"});
                location.reload();
            })
            .catch(er => {
                M.toast({html: 'İşlem sırasında bir hata oluştu!', classes: "red"});
                console.log("başarısız " + er);
            });
    }
    function musteriEkle() {
        let token = '{{csrf_token()}}';
       
        let telefon = document.querySelector("#modal0 #telefon").value;
        let isimSoyisim = document.querySelector("#modal0 #isimSoyisim").value;
        let tc = document.querySelector("#modal0 #tc").value;
        let adres = document.querySelector("#modal0 #adres").value;
        axios.post("/musteriEkle", {
                token: token,
                telefon: telefon,
                isimSoyisim: isimSoyisim,
                tc: tc,
                adres: adres
            })
            .then(res => {
                console.log("başarılı " + res);
                $('.modal').modal('close', ".modal");
                M.toast({html: 'İşlem başarılı!', classes: "green"});
                location.reload();
            })
            .catch(er => {
                M.toast({html: 'İşlem sırasında bir hata oluştu!', classes: "red"});
                console.log("başarısız " + er);
            });
    }
    function musteriSil(kid) {
        let token = '{{csrf_token()}}';
        axios.post("/musteriSil", {
                token: token,
                kid: kid,
            })
            .then(res => {
                console.log("başarılı " + res);
                $('.modal').modal('close', ".modal");
                M.toast({html: 'İşlem başarılı!', classes: "green"});
                document.getElementById("tr"+kid).remove();
            })
            .catch(er => {
                M.toast({html: 'İşlem sırasında bir hata oluştu!', classes: "red"});
                console.log("başarısız " + er);
            });
    }

</script>


@endsection
