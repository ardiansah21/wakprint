window.Vue = require("vue");

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