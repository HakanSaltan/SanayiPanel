@extends('layouts.app')

@section('css')
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
@endsection

@section('content')
    <div id="app">
        <div  class="card card-default scrollspy">
            <div class="row fill-width padding-1">
                <div class="col s12 m6">
                    <h5>{{$arac->plaka}} | {{$arac->marka}} {{$arac->model}}</h5>
                </div>
                <div class="col s12 m6 right-align" style="display:flex; flex-direction:column;">
                    <span class="uppercase">Toplam Fiyat: | toplamFiyatlar.toplamFiyat |₺</span>
                    <span class="uppercase">Toplam KDV: | toplamFiyatlar.toplamKDVFiyat |₺</span>
                </div>
            </div>
            <div class="row center-align">
                <div class="col s12 blue" style="padding: 1px;"></div>
            </div>
            <div class="card-content">
                <div class="container">
                    <div class="row center-align">
                        <form autocomplete="off">
                            <div class="col s12 m5">
                                <div class="input-field">
                                    <i class="material-icons prefix">build</i>
                                    <input
                                        class="validate autocompleter"
                                        placeholder="Yapılan Hizmet Adı"
                                        autocomplete="off"
                                        v-model="yapilanHizmetBilgileri.islemAdi"
                                        type="text"
                                        id="autocomplete-input"
                                    />
                                    <label for="autocomplete-input">Hizmet</label>
                                </div>
                            </div>
                            <div class="col s8 m3">
                                <div class="input-field">
                                    <i class="prefix">₺</i>
                                    <input
                                        id="fiyat"
                                        autocomplete="off"
                                        @input="yapilan_hizmetler = _j(yapilan_hizmetler)"
                                        v-model="yapilanHizmetBilgileri.fiyat"
                                        placeholder="Fiyat"
                                        class="validate"
                                        type="number"
                                    />
                                    <label for="fiyat">Fiyat</label>
                                </div>
                            </div>
                            <div class="col s2 m1">
                                <div class="input-field">
                                    <input
                                        id="adet"
                                        autocomplete="off"
                                        @input="yapilan_hizmetler = _j(yapilan_hizmetler)"
                                        v-model="yapilanHizmetBilgileri.adet"
                                        placeholder="Adet"
                                        class="validate"
                                        type="number"
                                    />
                                    <label for="adet">Adet</label>
                                </div>
                            </div>
                            <div class="col s2 m1 center-align">
                                <div class="input-field center-align">
                                    <p>
                                        <label>
                                            <input class="filled-in" type="checkbox" v-model="yapilanHizmetBilgileri.kar" />
                                            <span>Kâr</span>
                                        </label>
                                    </p>
                                </div>
                            </div>
                            <div class="col s12 m2 center-align">
                                <div class="input-field center-align">
                                    <a @click="ekle()" class="btn-floating waves-effect waves-light green pulse">
                                        <i class="material-icons">add</i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row center-align">
                        <div class="col s12 green" style="padding: 2px; margin-top: 24px; margin-bottom: 24px"></div>
                    </div>
                    <div class="row center-align scale-transition" v-if="yapilan_hizmetler.length">
                        <form autocomplete="off">
                            <table class="responsive-table">
                                <thead>
                                    <tr>
                                        <th><i class="material-icons tiny ">build</i>Hizmet Adı</th>
                                        <th><i class="prefix tiny ">₺</i>Hizmet Ücreti</th>
                                        <th>Adet</th>
                                        <th>Kâr</th>
                                        <th></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="(hizmet, i) in yapilan_hizmetler" :key="hizmet.ad" :style="hizmet.yeniHizmet ? 'border-left: 8px solid green' : ''">
                                        <td>
                                            <input class="validate" placeholder="Yapılan Hizmet Adı" autocomplete="off" v-model="hizmet.model" type="text" :class="'autocomplete' + i">
                                        </td>
                                        <td>
                                            <input autocomplete="off" @change="yapilan_hizmetler = _j(yapilan_hizmetler)" @input="yapilan_hizmetler = _j(yapilan_hizmetler)" v-model="hizmet.fiyat" placeholder="Fiyat" class="validate" type="number">
                                        </td>
                                        <td style="max-width: 125px">
                                            <input autocomplete="off" @change="yapilan_hizmetler = _j(yapilan_hizmetler)" @input="yapilan_hizmetler = _j(yapilan_hizmetler)" v-model="hizmet.adet" placeholder="Adet" class="validate" type="number">
                                        </td>
                                        <td>
                                            <p>
                                                <label>
                                                    <input class="filled-in" type="checkbox" v-model="hizmet.kar" />
                                                    <span></span>
                                                </label>
                                            </p>
                                        </td>
                                        <td>
                                            <div class="col s12 center-align">
                                                <a @click="sil(i)" class=" btn-floating  red">
                                                    <i class="material-icons">remove</i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                        
                        <div class="col s12 m4 center-align">
                            <p>
                                <label>
                                    <input type="checkbox" v-model="kdvEkle" />
                                    <span>KDV Ekle</span>
                                </label>
                            </p>
                        </div>
                        
                        <div class="col s12 m4 center-align">
                            <p>
                                <label>
                                    <input type="checkbox" v-model="fatura" />
                                    <span>Fatura oluştur</span>
                                </label>
                            </p>
                        </div>
                        <div class="col s12 m4 right-align">
                            <a @click="kaydet()" class="btn waves-effect waves-light green">
                                <i class="material-icons">done</i>
                            </a>
                        </div>
                    </div>
                    <div class="row center-align scale-transition padding-3" v-else>
                        <h5>Lütfen hizmet ekleyiniz...</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

<script>
    Vue.options.delimiters = ['|', '|'];

    let vm = new Vue({
        el: "#app",
        data: {
            kullanici: <?php echo $kullanici; ?>,
            arac: <?php echo $arac; ?>,
            hizmetler: <?= $hizmetler ?>,
            yapilanHizmetBilgileri: {
                islemAdi: "",
                fiyat: 0,
                kar: true,
                adet: 1,
            },
            ins: null,
            yapilan_hizmetler: [],
            kdvOrani: 18,
            kdvEkle: true,
            fatura: true
        },
        mounted() {
            this.$nextTick(() => {
                vm.hizmetGetir();

                vm.ins = M.Autocomplete.init(document.querySelector('.autocompleter'), {
                    data: vm.autocompleteDeger,
                    onAutocomplete: val => {
                        /*let son_index = vm.yapilan_hizmetler.length - 1;
                        vm.yapilan_hizmetler[son_index].model = val;
                        vm.yapilan_hizmetler[son_index] = { ...vm.yapilan_hizmetler[son_index], ...vm.autocompleteDegerBul(val)};*/
                        vm.yapilanHizmetBilgileri.islemAdi = val;
                        vm.yapilanHizmetBilgileri = { ...vm.yapilanHizmetBilgileri, ...vm.autocompleteDegerBul(val)};
                        vm.yapilan_hizmetler = vm._j(vm.yapilan_hizmetler);
                    }
                });
            });
        },
        computed: {
            autocompleteDeger() {
                return vm.hizmetler.reduce((acc, cur) => ({ ...acc, [cur.ad]: cur.img }), {});
            },
            toplamFiyatlar() {
                let veriler = {
                    toplamFiyat: 0,
                    toplamKDVFiyat: 0,
                };

                let kdvEkleDurum = this.kdvEkle;

                this.yapilan_hizmetler.forEach(v => {
                    let fiyat = parseFloat(v.fiyat) * parseFloat(v.adet);
                    if(!isNaN(fiyat) && fiyat > 0) {
                        veriler.toplamFiyat += fiyat;
                        veriler.toplamKDVFiyat += fiyat * this.kdvOrani / 100;

                        if(kdvEkleDurum)
                            veriler.toplamFiyat += veriler.toplamKDVFiyat;
                    }
                });

                return veriler;
            }
        },
        methods: {
            _j(v) {
                return JSON.parse(JSON.stringify(v));
            },
            autocompleteDegerBul(key) {
                return vm.hizmetler.find(o => o.ad == key);
            },
            sil(key) {
                vm.yapilan_hizmetler.splice(key, 1);
            },
            ekle() {
                if(!vm.yapilanHizmetBilgileri.islemAdi)
                    return M.toast({html: 'Lütfen işlem adı giriniz!', classes: 'rounded'});

                let yeniHizmet = !vm.autocompleteDegerBul(vm.yapilanHizmetBilgileri.islemAdi);

                vm.yapilan_hizmetler.push({
                    model: vm._j(vm.yapilanHizmetBilgileri.islemAdi),
                    fiyat: vm.yapilanHizmetBilgileri.fiyat,
                    yeniHizmet,
                    kar: vm.yapilanHizmetBilgileri.kar,
                    ...(yeniHizmet ? null : vm.yapilanHizmetBilgileri)
                });

                vm.yapilanHizmetBilgileri = {
                    islemAdi: "",
                    fiyat: 0,
                    kar: vm.yapilanHizmetBilgileri.kar,
                    adet: 1,
                };

                document.querySelector(".autocompleter").focus();
            },
            kaydet() {
                axios.post("/hizmetEkle", {
                    arac_id: vm.arac.id,
                    musteri_id: vm.arac.musteri_id,
                    hizmet_fiyat: vm.toplamFiyatlar.toplamFiyat,
                    hizmet_kdv: vm.kdvOrani,
                    fatura: vm.fatura,
                    kdvEkleDurum: vm.kdvEkle,
                    yapilan_hizmetler: vm.yapilan_hizmetler
                })
                .then(donen => {
                    if(!donen.data.sonuc)
                        return M.toast({html: 'İşlem sırasında bir hata oluştu!', classes: "red"});

                    M.toast({html: 'İşlem başarılı!', classes: "green"});
                    vm.yapilan_hizmetler = [];
                    location.href = "/aracDetay/";
                })
                .catch(e => {
                    console.log(e);
                    return M.toast({html: 'İşlem sırasında bir hata oluştu!', classes: "red"});
                });
            },
            hizmetGetir() {
                /*axios.post("/");*/
                /*vm.ekle();*/
            }
        },
    });
</script>
@endsection
