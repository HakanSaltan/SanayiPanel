@extends('layouts.app')

@section('css')

@endsection
@section('content')
<div class="row">
    <div  class="card">
        <div class="card-content">
                <div class="col s12">
                <h4 class="uppercase center-align">{{str_replace("_", " ", $arac->plaka)}}</h4>
                </div>   
            <div class="col s6">
                    <p class=" uppercase caption mb-0"> <br> {{$arac->marka}} - {{$arac->model}}</p>
            </div>
            <div class="col s6">
                    <p class="caption mb-0 right-align"> <br> Tarih : {{date('d-m-Y')}}</p>
                </div>
            </div>
            
        </div>
    </div>
</div>

           
<div id="app">
    <div  class="card card-default scrollspy">
        <div class="card-content">
            <div class="container">
                <div class="row center-align">
                    <form autocomplete="off">
                        <div class="col s12 m7">
                            <div class="input-field">
                                <i class="material-icons prefix">build</i>
                                <input class="validate autocompleter" placeholder="Yapılan Hizmet Adı" autocomplete="off" v-model="yapilanHizmetBilgileri.islemAdi" type="text" id="autocomplete-input">
                            </div>
                        </div>
                        <div class="col s12 m3">
                            <div class="input-field">
                                <i class="prefix">₺</i>
                                <input
                                    autocomplete="off"
                                    @input="yapilan_hizmetler = _j(yapilan_hizmetler)"
                                    v-model="yapilanHizmetBilgileri.fiyat"
                                    placeholder="Fiyat"
                                    class="validate"
                                    type="number"
                                >
                            </div>
                        </div>
                        <div class="col s12 m2 center-align">
                            <a @click="ekle()" class="btn-floating waves-effect waves-light green pulse">
                                <i class="material-icons">add</i>
                            </a>
                        </div>
                    </form>
                </div>
                <div class="row center-align">
                    <div class="col s12 green" style="padding: 2px; margin-top: 24px; margin-bottom: 24px"></div>
                </div>
                <div class="row center-align scale-transition" v-if="yapilan_hizmetler.length">
                    <form autocomplete="off">
                        <table class="highlight">
                            <thead>
                                <tr>
                                    <th><i class="material-icons tiny padding-1">build</i>Hizmet Adı</th>
                                    <th><i class="prefix tiny padding-1">₺</i>Hizmet Ücreti</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="(hizmet, i) in yapilan_hizmetler" :key="hizmet.ad">
                                    <td>
                                        <div class="input-field">
                                            <input class="validate" placeholder="Yapılan Hizmet Adı" autocomplete="off" v-model="hizmet.model" type="text" :class="'autocomplete' + i">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="input-field">
                                            <input autocomplete="off" @change="yapilan_hizmetler = _j(yapilan_hizmetler)" @input="yapilan_hizmetler = _j(yapilan_hizmetler)" v-model="hizmet.fiyat" placeholder="Fiyat" class="validate" type="number">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="col s12 center-align">
                                            <a @click="sil(i)" class=" btn-floating waves-effect waves-light red">
                                                <i class="material-icons">remove</i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                    <div class="col s12 m5 justify-content-end">
                        <h5 class="uppercase">Toplam Fiyat: | toplamFiyatlar.toplamFiyat |₺</h5>
                    </div>
                    <div class="col s12 m5 justify-content-end">
                        <h5 class="uppercase">Toplam KDV: | toplamFiyatlar.toplamKDVFiyat |₺</h5>
                    </div>
                    <div class="col s12 m2 justify-content-end">
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
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

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
                fiyat: 0
            },
            ins: null,
            yapilan_hizmetler: [],
            kdvOrani: 18
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

                this.yapilan_hizmetler.forEach(v => {
                    let fiyat = parseFloat(v.fiyat);
                    if(!isNaN(fiyat) && fiyat > 0) {
                        veriler.toplamFiyat += fiyat;
                        veriler.toplamKDVFiyat += fiyat * this.kdvOrani / 100;
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

                vm.yapilan_hizmetler.push({
                    model: vm._j(vm.yapilanHizmetBilgileri.islemAdi),
                    ...vm.yapilanHizmetBilgileri
                });

                vm.yapilanHizmetBilgileri = {
                    islemAdi: "",
                    fiyat: 0
                };
                document.querySelector(".autocompleter").focus();
            },
            kaydet() {
                axios.post("/hizmetEkle", {
                    arac_id: vm.arac.id,
                    musteri_id: vm.arac.musteri_id,
                    hizmet_fiyat: vm.toplamFiyatlar.toplamFiyat,
                    hizmet_kdv: vm.kdvOrani,
                    yapilan_hizmetler: vm.yapilan_hizmetler
                })
                .then(donen => {
                    if(!donen.data.sonuc)
                        return M.toast({html: 'İşlem sırasında bir hata oluştu!', classes: "red"});

                    M.toast({html: 'İşlem başarılı!', classes: "green"});
                    vm.yapilan_hizmetler = [];
                })
                .catch(console.log)
            },
            hizmetGetir() {
                /*axios.post("/");*/
                /*vm.ekle();*/
            }
        },
    });
</script>
@endsection
