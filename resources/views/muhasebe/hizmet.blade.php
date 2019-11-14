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
                    <p class=" uppercase caption mb-0"> <br> {{$arac->marka}} - {{$arac->model}} Araca Ait Hizmet Sayfası</p>
            </div>
            <div class="col s6">
                    <p class="caption mb-0 right-align"> <br> Tarih : {{date('d-m-Y')}}</p>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div  class="card card-default scrollspy">
    
    <div class="card-content">
           
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col s6 justify-content-center">
                        <h5 class="uppercase">Hizmet Oluştur</h5>
                    </div>
                    <div style="bottom: 50px; right: 90px;" class="fixed-action-btn direction-top">
                            <a class="btn-floating btn-large primary-text gradient-shadow modal-trigger" @click="ekle()">
                                    <i class="material-icons">build</i>
                            </a>
                    </div>
                </div>
            </div>
            <div class="container" v-for="(veri, index) in yapilan_hizmetler" :key="index + 'div'">
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
                                                    <input autocomplete="off" v-model="veri.fiyat" placeholder="Fiyat" class="validate" type="number">
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
            hizmetler: [
                { id: 0, ad: "İşçilik", kod: "ISCILIK", img: null },
                { id: 1, ad: "Deneme", kod: "DENEME", img: null },
            ],
            ins: null,
            yapilan_hizmetler: []
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
        },
        methods: {
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
                        }
                    });
                });

                vm.$nextTick(() => {
                    if(document.getElementById("model" + (vm.hizmetler.length - 1)))
                        document.getElementById("model" + (vm.hizmetler.length - 1)).focus();
                });
            },
            kaydet() {

            },
            hizmetGetir() {
                /*axios.post("/");*/
                vm.ekle();
            }
        },
    });
</script>
@endsection
