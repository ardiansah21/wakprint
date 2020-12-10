window.Vue = require("vue");

// Vue.component(
//     "konfigurasi-pesanan",
//     require("./components/KonfigurasiPesanan.vue").default
// );
import konfigurasiPesananComponent from "./components/KonfigurasiPesanan.vue";

const konfigurasiPesanan = new Vue({
    el: "#konfigurasiPesanan",
    components: {
        konfigurasiPesananComponent
    },
    methods: {
        gotosite(producturl) {
            window.location.href = producturl;
        }
    }
});