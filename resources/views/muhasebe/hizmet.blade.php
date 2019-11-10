@extends('layouts.app')

@section('css')

@endsection
@section('content')

<div id="app">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm justify-content-center">
                Hizmet oluştur
            </div>
            <div class="col-sm justify-content-center">
                <button @click="ekle()" type="button" class="btn btn-primary">YENİ</button>
            </div>
        </div>
    </div>
    <div class="container" v-for="(veri, index) in veriler" :key="index + 'div'">
        <div class="row justify-content-center">
            <div class="col-sm justify-content-center">
                <div class="row">
                    <div class="col s12">
                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">textsms</i>
                                <input v-model="veri.model" type="text" :id="'model' + index" class="autocomplete">
                                <label :for="'model' + index">Autocomplete |index|</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm justify-content-center">
                | veri.fiyat |₺
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

@endsection

@section('js')
<script>
    Vue.options.delimiters = ['|', '|'];

    let vm = new Vue({
        el: "#app",
        data: {
            kullanici: <?php echo $kullanici; ?>,
            arac: <?php echo $arac; ?>,
            veriler: []
        },
        mounted() {
            this.$nextTick(() => {
                vm.ekle();
            });
        },
        methods: {
            ekle() {
                var elems = document.querySelectorAll('.autocomplete');
                var instances = M.Autocomplete.init(elems, {
                    data: {
                        "Apple": "Deneme"
                    }
                });

                vm.veriler.push({
                    fiyat: Math.round(Math.random(1) * 100)
                });

                vm.$nextTick(() => {
                    console.log(document.getElementById("model" + (vm.veriler.length - 1)));

                    if(document.getElementById("model" + (vm.veriler.length - 1)))
                        document.getElementById("model" + (vm.veriler.length - 1)).focus();
                });
            }
        },
    });
</script>
@endsection
