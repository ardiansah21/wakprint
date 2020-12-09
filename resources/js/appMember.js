require("./bootstrap");

window.Vue = require("vue");

import konfigurasiPesananComponent from "./components/KonfigurasiPesanan.vue";
import pencarianProdukParnerComponent from "./components/pencarianProdukParnerComponent.vue";
import cardProdukComponent from "./components/cardProdukComponent.vue";
import "./chatVue.js";

const appMember = new Vue({
    el: "#app",
    components: {
        konfigurasiPesananComponent,
        cardProdukComponent,
        pencarianProdukParnerComponent
    },
    data: {
        pesanans: []
    },
    methods: {
        gotosite(url) {
            window.location.href = url;
        }
    },
    mounted() {
        axios.get("/chat/pesanan").then(({ data }) => {
            this.pesanans = data;
        });
        Echo.channel(
            "channel-chat-member." +
            document.querySelector('meta[name="user_id"]').content
        ).listen("ChatEvent", e => {
            var idx = this.pesanans.findIndex(
                p => p.id_pesanan === e.id_pesanan
            );
            this.pesanans[idx].count++;
            var audio = new Audio("/storage/ringtone/glass_ping.mp3");
            audio.play();
        });
    },
    computed: {
        notifChat: {
            get: function() {
                var count = 0;
                this.pesanans.filter(e => {
                    if (e.count > 0) {
                        count++;
                    }
                });
                return count;
            },
            set: function(val) {
                return val;
            }
        }
    }
});
