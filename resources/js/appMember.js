require("./bootstrap");

window.Vue = require("vue");
import VTooltip from "v-tooltip";
Vue.use(VTooltip);

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
        pesanans: [],
        user_login: {}
    },
    methods: {
        gotosite(url) {
            window.location.href = url;
        },
        rupiah: function(val) {
            return (
                "Rp. " +
                val.toString().replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1.")
            );
        }
    },
    mounted() {
        if (document.querySelector('meta[name="user_id"]') != null) {
            this.user_login = JSON.parse(
                document.querySelector('meta[name="user_login"]').content
            );
            axios.get("/chat/pesanan").then(({ data }) => {
                this.pesanans = data;
            });

            Echo.channel(
                "channel-chat-member." + this.user_login.id_member
            ).listen("ChatEvent", e => {
                var idx = this.pesanans.findIndex(
                    p => p.id_pesanan === e.id_pesanan
                );
                this.pesanans[idx].count++;
                var audio = new Audio("/storage/ringtone/glass_ping.mp3");
                audio.play();
            });
        } else this.user_login = {};
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
