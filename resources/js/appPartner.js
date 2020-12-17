require("./bootstrap.js");

window.Vue = require("vue");

import "./chatPartnerVue";

const appPartner = new Vue({
    el: "#app",
    components: {},
    data: {
        pesanans: []
    },
    methods: {},
    mounted() {
        axios.get("/chat/pesanan").then(({ data }) => {
            this.pesanans = data;
        });
        // Echo.channel(
        //     "chanel-chat-partner." +
        //     document.querySelector('meta[name="user_id"]').content
        // ).listen("chatEvent", e => {
        //     var idx = this.pesanans.findIndex(
        //         p => p.id_pesanan === e.id_pesanan
        //     );
        //     this.pesanans[idx].count++;

        //     var audio = new Audio("/storage/ringtone/glass_ping.mp3");
        //     audio.play();
        // });
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
