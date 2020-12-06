// require("./bootstrap");
const { default: Axios } = require("axios");

window.Vue = require("vue");

const chat = new Vue({
    el: "#app",
    data: {
        // user_login: document.querySelector('meta[name="user_login"]').content,
        id: document.querySelector('meta[name="user_id"]').content,
        pesanans: [],
        isActive: null,
        form: {
            from_user: "member",
            id_pesanan: "",
            id_member: "",
            id_pengelola: "",
            pesan: ""
        },
        messages: [],
        pengelola: {
            nama: "",
            avatar: ""
        }
    },
    methods: {
        fetchPesanan() {
            Axios.get("/chat/pesanan").then(({ data }) => {
                this.pesanans = data;
                let urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has("pesanan")) {
                    this.fetchMessages(parseInt(urlParams.get("pesanan")));
                }
            });
        },
        fetchMessages(id) {
            var idx = this.pesanans.findIndex(p => p.id === id);
            if (idx != -1) {
                this.form.id_pesanan = this.pesanans[idx].id_pesanan;
                this.form.id_member = this.pesanans[idx].id_member;
                this.form.id_pengelola = this.pesanans[idx].id_pengelola;
                this.pengelola.nama = this.pesanans[idx].nama_pengelola;
                this.pengelola.avatar = this.pesanans[idx].avatar;
                Axios.get("/chat/message/" + id).then(({ data }) => {
                    this.messages = data;
                    this.isActive = this.pesanans.findIndex(p => p.id == id);
                    this.pesanans[this.isActive].count = 0;
                    this.notifChat--;
                });
            }
        },
        sendMessage() {
            Axios.post("/chat/message", this.form).then(({ data }) => {
                this.form.pesan = "";
                // this.pushMessage(data, data.id_pesanan);
                this.messages.push(data);
            });
        },
        fetchPusher() {
            Echo.channel("channel-chat-member." + this.id).listen(
                "ChatEvent",
                e => {
                    console.log(e);
                    // this.pushMessage(e, e.id_pesanan, "push");
                    this.playSoundNotif();
                    var idx = this.pesanans.findIndex(
                        p => p.id_pesanan === e.id_pesanan
                    );
                    this.pesanans[idx].count++;

                    if (this.form.id_pesanan == e.id_pesanan) {
                        this.messages.push(e);
                        this.pesanans[idx].count = 0;
                        this.isActive = idx;
                        Axios.get(
                            "/chat/message/" + this.form.id_pesanan + "/read"
                        );
                    }
                }
            );
        },
        // pushMessage(data, pesanan_id, action = "") {
        //     var idx = this.pesanans.findIndex(p => p.id_pesanan === pesanan_id);
        //     if (idx != -1 && action == "push") {
        //         this.pesanans.splice(idx, 1); //menghapus list pesanan
        //     }
        //     /**
        //      * if untuk pesan submit
        //      */
        //     if (action == "") {
        //         var pesanan = this.pesanans[idx];
        //         this.pesanans.splice(idx, 1);
        //         this.pesanans.unshift(pesanan);
        //     } else {
        //         /**
        //          * else untuk pesan dari laravel echo
        //          */
        //         this.pesanans.unshift(data);
        //     }
        // },
        // agar scroll ke arah pesan yang baru
        scrollToEnd: function() {
            let container = this.$el.querySelector("#message-scroll");
            container.scrollTop = container.scrollHeight;
        },
        playSoundNotif() {
            var audio = new Audio("/storage/ringtone/glass_ping.mp3");
            audio.play();
        }
    },
    mounted() {
        console.log("tadaaaa");
        this.fetchPesanan();
        this.fetchPusher();
    },
    watch: {
        messages: _.debounce(function() {
                this.scrollToEnd();
            }, 10)
            // pesanans: _.debounce(function() {
            //     this.notifChat = 0;
            //     this.pesanans.filter(e => {
            //         console.log(e.count);
            //         if (e.count) {
            //             this.notifChat++;
            //         }
            //     });
            // }, 10)
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
