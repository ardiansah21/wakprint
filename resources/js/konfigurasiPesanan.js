window.Vue = require("vue");

Vue.component(
    "konfigurasi-pesanan",
    require("./components/KonfigurasiPesanan.vue").default
);

const konfigurasiPesanan = new Vue({
    el: "#konfigurasiPesanan",
    props: ["pesanan"],
    data: {
        ayam: 99
    },
    methods: {
        gotosite(producturl) {
            window.location.href = producturl;
        }
    }
});