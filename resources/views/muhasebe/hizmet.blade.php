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
    <div  class="card card-default scrollspy padding-1">
        <div class="container">
            <div class="row center-align">
                <div class="col s12 m5 justify-content-end">
                    <h5 class="uppercase">Toplam Fiyat: | toplamFiyatlar.toplamFiyat |₺</h5>
                </div>
                <div class="col s12 m5 justify-content-end">
                    <h5 class="uppercase">Toplam KDV: | toplamFiyatlar.toplamKDVFiyat |₺</h5>
                </div>
                <div class="col s12 m2 justify-content-end">
                    <a @click="kaydet()" class="btn-floating btn-large waves-effect waves-light green">
                        <i class="material-icons">done</i>
                    </a>
                </div>
                <div style="bottom: 50px; right: 90px;" class="fixed-action-btn direction-top">
                    <a class="btn-floating btn-large primary-text gradient-shadow pulse" @click="ekle()">
                        <i class="material-icons">build</i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container" v-for="(veri, index) in yapilan_hizmetler" :key="index + 'div'">
        <div  class="card card-default scrollspy hoverable">
            <div class="card-content">
                <div class="row">
                    <div class="col-sm">
                        <div class="row">
                            <div class="col s12">
                                <div class="row">
                                    <form autocomplete="off">
                                        <div class="col s12 m8">
                                            <div class="row">
                                                <div class="input-field">
                                                    <i class="material-icons prefix">build</i>
                                                    <input class="validate" placeholder="Yapılan Hizmet Adı" autocomplete="off" v-model="veri.model" type="text" id="autocomplete-input" :class="'autocomplete' + index">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m4">
                                            <div class="row">
                                                <div class="input-field">
                                                    <i class="prefix">₺</i>
                                                    <input autocomplete="off" @change="yapilan_hizmetler = _j(yapilan_hizmetler)" @input="yapilan_hizmetler = _j(yapilan_hizmetler)" v-model="veri.fiyat" placeholder="Fiyat" class="validate" type="number">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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
            ins: null,
            yapilan_hizmetler: [],
            kdvOrani: 18
        },
        mounted() {
            this.$nextTick(() => {
                vm.hizmetGetir();
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
            ekle() {

                vm.yapilan_hizmetler.push({});

                vm.$forceUpdate();

                let son_index = vm.yapilan_hizmetler.length - 1;

                vm.$nextTick(() => {
                    var elems = document.querySelector('.autocomplete' + son_index);
                    vm.ins = M.Autocomplete.init(elems, {
                        data: vm.autocompleteDeger,
                        onAutocomplete: val => {
                            vm.yapilan_hizmetler[son_index].model = val;
                            vm.yapilan_hizmetler[son_index] = { ...vm.yapilan_hizmetler[son_index], ...vm.autocompleteDegerBul(val)};
                            vm.yapilan_hizmetler = vm._j(vm.yapilan_hizmetler);
                        }
                    });
                });

                vm.$nextTick(() => {
                    if(document.getElementById("model" + (vm.hizmetler.length - 1)))
                        document.getElementById("model" + (vm.hizmetler.length - 1)).focus();
                });
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
                vm.ekle();
            }
        },
    });
</script>
@endsection
