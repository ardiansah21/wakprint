require("./bootstrap.js");

//notif
import * as PusherPushNotifications from "@pusher/push-notifications-web";
const beamsClient = new PusherPushNotifications.Client({
    instanceId: "0c6761bf-20c1-49a9-a69f-54cf93cc75d5"
});
if (document.querySelector('meta[name="user_id"]') != null) {
    beamsClient
        .start()
        .then(() =>
            beamsClient.addDeviceInterest(
                "Notif.Partner." +
                document.querySelector('meta[name="user_id"]').content
            )
        )
        .then(() =>
            console.log(
                "Successfully registered and subscribed Notification!" +
                " Notif-Partner." +
                document.querySelector('meta[name="user_id"]').content
            )
        )
        .catch(console.error);
}

window.Vue = require("vue");

import "./chatPartnerVue";
import Axios from "axios";

const appPartner = new Vue({
    el: "#app",
    components: {},
    data: {
        pesanans: [],
        user_login: {},
        notification: []
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
        },
        readchat(notif) {
            Axios.post("/notif/read", notif).then(({ data }) => {
                this.notification = data;
                this.gotosite(notif.url);
            });
        },
        readAll() {
            Axios.get("/notif/read-all").then(({ data }) => {
                this.notification = data;
            });
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
            axios.get("/notif").then(({ data }) => {
                this.notification = data;
            });
            Echo.channel(
                "chanel-chat-partner." +
                document.querySelector('meta[name="user_id"]').content
            ).listen("chatEvent", e => {
                var idx = this.pesanans.findIndex(
                    p => p.id_pesanan === e.id_pesanan
                );
                this.pesanans[idx].count++;

                var audio = new Audio("/storage/ringtone/glass_ping.mp3");
                audio.play();
            });

            Echo.private(
                "Notif-Broadcast.Partner." +
                document.querySelector('meta[name="user_id"]').content
            ).notification(notification => {
                this.notification.push(notification);

                var audio = new Audio("/storage/ringtone/glass_ping.mp3");
                audio.play();
                console.log(notification);
            });
        } else this.user_login = {};
    },
    computed: {
        notif: function() {
            if (this.notification.length != undefined) {
                return this.notification.length;
            }
            return 0;
        },
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
