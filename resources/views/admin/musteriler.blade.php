@extends('layouts.app')

@section('css')

<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-sidebar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/app-contacts.css') }}">
@endsection
@section('content')

<div style="bottom: 50px; right: 90px;" class="fixed-action-btn direction-top">
    <a class="btn-floating btn-large primary-text gradient-shadow modal-trigger" href="#modal">
        <i class="material-icons">person_add</i>
    </a>
</div>

<div id="modal" class="modal border-radius-6">
    <div class="modal-content">
        <h5 class="mt-0">Yeni Müşteri Ekle</h5>
        <hr>
        <div class="row">
            <form class="col s12">
                <div class="row">
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix"> perm_identity </i>
                        <input id="first_name" type="text" class="validate">
                        <label for="first_name">Ad Soyad</label>
                    </div>
                    <div class="input-field col m6 s12">
                        <i class="material-icons prefix"> business </i>
                        <input id="company" type="text" class="validate">
                        <label for="company">Tc</label>
                    </div>
                </div>
                <div class="row">

                    <div class="input-field col s12">
                        <i class="material-icons prefix"> call </i>
                        <input id="phone" type="number" class="validate">
                        <label for="phone">Telefon</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix"> note </i>
                        <input id="notes" type="text" class="validate">
                        <label for="notes">Adres</label>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="modal-footer">
        <a class="btn modal-close waves-effect waves-light mr-2">Müşteri Ekle</a>
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
                        <tr>
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
                                    class="waves-effect waves-light btn gradient-45deg-light-blue-cyan mt-7 z-depth-4 animated rubberBand faster modal-trigger ">Güncelle</a></td>
                            
                            
                            
                            <td><a data-target="" class="btn waves-effect waves-light gradient-45deg-red-pink mt-7 z-depth-4 animated rubberBand faster modal-trigger ">Sil</a>

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
                                                <label for="first_name">Ad Soyad</label>
                                            </div>
                                            <div class="input-field col m6 s12">
                                                <i class="material-icons prefix"> business </i>
                                                <input id="company" type="text" value="{{$kullanici->tc}}"
                                                    class="validate">
                                                <label for="company">Tc</label>
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="input-field col s12">
                                                <i class="material-icons prefix"> call </i>
                                                <input id="telefon" type="number" value="{{$kullanici->telefon}}"
                                                    class="validate">
                                                <label for="phone">Telefon</label>
                                            </div>
                                            <div class="input-field col s12">
                                                <i class="material-icons prefix"> note </i>
                                                <input id="adres" type="text" value="{{$kullanici->adres}}"
                                                    class="validate">
                                                <label for="notes">Adres</label>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a class="btn modal-close waves-effect waves-light mr-2">Müşteri Güncelle</a>
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
    function musteriGuncelle() {
        let token = '{{csrf_token()}}';
        let telefon = document.getElementById("telefon");
        let isimSoyisim = document.getElementById("isimSoyisim");
        let tc = document.getElementById("tc");
        let adres = document.getElementById("adres");


        axios.post("/musteriGuncelle/" + kullanici - > id, {
                token: token,
                telefon: telefon,
                isimSoyisim: isimSoyisim,
                tc: tc,
                adres: adres
            })
            .then(res => {
                console.log("başarılı " + res);
            })
            .catch(er => {
                console.log("başarısız " + er);
            });
    }

</script>


@endsection
